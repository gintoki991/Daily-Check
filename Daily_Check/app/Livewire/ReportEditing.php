<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\DailyReport;
use App\Models\Site;
use App\Models\Scheduled;
use App\Models\ScheduledUser;
use App\Models\ScheduledUserRole;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class ReportEditing extends Component
{
    public $reportId;
    public $date;
    public $start_time;
    public $end_time;
    public $sites;
    public $person_in_charge;
    public $comment;
    public $selectedEmployees = [];
    public $employees;
    public $selectedSite;
    public $scheduled_id;

    protected $rules = [
        'date' => 'required|date|after_or_equal:2023-01-01',
        'start_time' => 'required',
        'end_time' => 'required',
        'selectedSite' => 'required|integer|exists:sites,id',
        'person_in_charge' => 'required|integer|exists:users,id',
        'comment' => 'nullable|string|max:255',
        'selectedEmployees' => 'array',
        'selectedEmployees.*' => 'integer|exists:users,id',
    ];

    public function mount($reportId)
    {
        $this->reportId = $reportId;
        $this->employees = User::all();
        $this->sites = Site::all();

        try {
            $report = DailyReport::with(['actualUsers', 'scheduled', 'personInCharge'])->findOrFail($reportId);
            Log::info('DailyReport found with reportId: ' . $reportId);

            $this->start_time = $report->start_time;
            $this->end_time = $report->end_time;
            $this->selectedSite = $report->site_id;
            $this->date = $report->scheduled->date;
            $this->person_in_charge = $report->person_in_charge;
            $this->comment = $report->comment;
            $this->selectedEmployees = $report->actualUsers->pluck('id')->toArray();
            $this->scheduled_id = $report->scheduled_id;
        } catch (\Exception $e) {
            Log::error('Error in ReportEditing mount: ' . $e->getMessage());
        }
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            Log::info('Update process started for reportId: ' . $this->reportId);

            $validated = $this->validate();
            Log::info('Validation successful.', $validated);

            // 日付を正しい形式に変換
            $formattedDate = Carbon::parse($this->date)->format('Y-m-d');

            // Scheduledテーブルにデータを保存または取得
            $scheduled = Scheduled::firstOrCreate(['date' => $formattedDate]);
            $this->scheduled_id = $scheduled->id;
            Log::info('Scheduled record created or found with ID: ' . $this->scheduled_id);

            // 更新処理
            $report = DailyReport::findOrFail($this->reportId);
            $report->update([
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'site_id' => $this->selectedSite,
                'person_in_charge' => $this->person_in_charge,
                'comment' => $this->comment,
                'scheduled_id' => $this->scheduled_id,
            ]);
            Log::info('DailyReport updated for reportId: ' . $this->reportId);

            // 1. 全ての ScheduledUser をトランザクション内で作成
            $this->createAllScheduledUsers();

            DB::commit();
            Log::info('Transaction committed.');

            // 2. トランザクション外で ScheduledUserRole を一度に作成
            $this->createAllScheduledUserRoles();

            session()->flash('success', '日報が正常に更新されました。');
            return redirect()->route('report-display', ['date' => $this->date, 'site_id' => $this->selectedSite]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error('Validation error: ' . json_encode($e->errors()));
            session()->flash('error', 'バリデーションエラーが発生しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error during update: ' . $e->getMessage());
            session()->flash('error', 'データの更新に失敗しました: ' . $e->getMessage());
        }
    }

    protected function createAllScheduledUsers()
    {
        // 既存のScheduledUserとScheduledUserRoleを削除
        ScheduledUserRole::whereHas('scheduledUser', function ($query) {
            $query->where('scheduled_id', $this->scheduled_id);
        })->delete();
        Log::info('Existing ScheduledUserRoles deleted.');

        ScheduledUser::where('scheduled_id', $this->scheduled_id)->delete();
        Log::info('Existing ScheduledUsers deleted.');

        // 新しいScheduledUserを作成
        foreach ($this->selectedEmployees as $employeeId) {
            try {
                Log::info("Creating ScheduledUser for employeeId: $employeeId");

                $scheduledUser = ScheduledUser::firstOrCreate([
                    'scheduled_id' => $this->scheduled_id,
                    'user_id' => $employeeId,
                    'site_id' => $this->selectedSite,
                ]);

                $scheduledUser->refresh();
                Log::info('ScheduledUser created or found with ID: ' . $scheduledUser->id);
            } catch (\Exception $e) {
                Log::error('Error creating ScheduledUser for employeeId: ' . $employeeId . ' - ' . $e->getMessage());
            }
        }
    }

    protected function createAllScheduledUserRoles()
    {
        foreach ($this->selectedEmployees as $employeeId) {
            try {
                $scheduledUser = ScheduledUser::where('scheduled_id', $this->scheduled_id)
                    ->where('user_id', $employeeId)
                    ->where('site_id', $this->selectedSite)
                    ->first();

                if ($scheduledUser) {
                    Log::info('Creating ScheduledUserRole for ScheduledUser ID:', ['scheduled_user_id' => $scheduledUser->id]);
                    $this->createScheduledUserRole($scheduledUser);
                } else {
                    Log::warning('ScheduledUser not found for employeeId: ' . $employeeId);
                    throw new \Exception('ScheduledUser not found after creation.');
                }
            } catch (\Exception $e) {
                Log::error('Error creating ScheduledUserRole for employeeId: ' . $employeeId . ' - ' . $e->getMessage());
            }
        }
    }

    protected function createScheduledUserRole($scheduledUser)
    {
        // 重複チェック: ScheduledUserRoleが既に存在するか確認
        $existingRole = ScheduledUserRole::where('scheduled_user_id', $scheduledUser->id)
            ->where('is_actual', true)
            ->where('is_scheduled', true)
            ->first();

        if (!$existingRole) {
            ScheduledUserRole::create([
                'scheduled_user_id' => $scheduledUser->id,
                'is_scheduled' => true,
                'is_actual' => true,
            ]);
            Log::info('ScheduledUserRole created for ScheduledUser ID: ' . $scheduledUser->id);
        } else {
            Log::info('ScheduledUserRole already exists, skipping creation for ScheduledUser ID: ' . $scheduledUser->id);
        }
    }

    public function render()
    {
        return view('livewire.report-editing', [
            'employees' => $this->employees,
            'sites' => $this->sites,
        ])->layout('daily-check.report_editing');
    }
}
