<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\DailyReport;
use App\Models\Site;
use App\Models\Scheduled;
use App\Models\ScheduledUser;
use App\Models\ScheduledUserRole;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

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
            $report = DailyReport::with(['scheduled', 'personInCharge', 'roles.scheduledUser'])->findOrFail($reportId);
            Log::info('DailyReport found with reportId: ' . $reportId);
            $this->start_time = $report->start_time;
            $this->end_time = $report->end_time;
            $this->selectedSite = $report->site_id;
            $this->date = $report->scheduled->date;
            $this->person_in_charge = $report->person_in_charge;
            $this->comment = $report->comment;
            $this->scheduled_id = $report->scheduled_id;

            // DBに保存された従業員の user_id を取得し、チェックボックスに反映
            $this->selectedEmployees = ScheduledUser::where('scheduled_id', $this->scheduled_id)
                ->where('site_id', $this->selectedSite)
                ->whereHas('roles', function ($query) {
                    $query->where('is_actual', true);
                })
                ->pluck('user_id')
                ->toArray();

            Log::info('Selected Employees IDs:', $this->selectedEmployees);
        } catch (\Exception $e) {
            Log::error('Error in ReportEditing mount: ' . $e->getMessage());
        }
    }

    public function updatedDate($value)
    {
        // 新しい date に基づいて scheduled_id を取得
        $newScheduled = Scheduled::firstOrCreate(['date' => $value]);

        $this->scheduled_id = $newScheduled->id;
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            Log::info('Update process started.');

            $validated = $this->validate();
            Log::info('Validation passed.', $validated);

            // 既存のデータと比較してsite_idが変更されたかチェック
            $report = DailyReport::findOrFail($this->reportId);
            $oldSiteId = $report->site_id;
            $isSiteChanged = $oldSiteId !== $this->selectedSite;

            // 更新処理
            $report->update([
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'site_id' => $this->selectedSite,
                'person_in_charge' => $this->person_in_charge,
                'comment' => $this->comment,
                'scheduled_id' => $this->scheduled_id,
            ]);
            Log::info('DailyReport updated.');

            // 現場が変更された場合、古い関連データを削除
            if ($isSiteChanged) {
                Log::info('Site changed, deleting old ScheduledUserRoles.');
                ScheduledUserRole::whereHas('scheduledUser', function ($query) use ($oldSiteId) {
                    $query->where('scheduled_id', $this->scheduled_id)
                        ->where('site_id', $oldSiteId);
                })->delete();
                Log::info('Old ScheduledUserRoles deleted.');
            }

            // 既存のScheduledUserRoleを削除（変更された場合や、追加された場合に対応）
            ScheduledUserRole::whereHas('scheduledUser', function ($query) {
                $query->where('scheduled_id', $this->scheduled_id)
                    ->where('site_id', $this->selectedSite);
            })->delete();
            Log::info('Existing ScheduledUserRoles deleted.');

            $this->createAllScheduledUsers(); // ScheduledUserを先に作成

            DB::commit();
            Log::info('Transaction committed.');

            // 2. トランザクション外で ScheduledUserRole を一度に作成
            $this->createAllScheduledUserRoles();

            session()->flash('success', '日報が正常に更新されました。');
            // return redirect()->route('ReportDisplay', ['date' => $this->date, 'site_id' => $this->selectedSite]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error('Validation error: ' . json_encode($e->errors()));
            session()->flash('error', 'バリデーションエラーが発生しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating DailyReport: ' . $e->getMessage());
            session()->flash('error', 'データの更新に失敗しました: ' . $e->getMessage());
        }
    }

    protected function createAllScheduledUsers()
    {
        foreach ($this->selectedEmployees as $employeeId) {
            try {
                Log::info("Creating ScheduledUser for employeeId: $employeeId");

                // 変数が適切に設定されているか確認
                if (is_null($this->scheduled_id) || is_null($employeeId) || is_null($this->selectedSite)) {
                    throw new \Exception('ScheduledUser creation failed due to null value(s).');
                }
                Log::info('ScheduledUser creation parameters:', [
                    'scheduled_id' => $this->scheduled_id,
                    'user_id' => $employeeId,
                    'site_id' => $this->selectedSite,
                ]);

                // まずはScheduledUserを作成または取得
                $scheduledUser = ScheduledUser::firstOrCreate([
                    'scheduled_id' => $this->scheduled_id,
                    'user_id' => $employeeId,
                    'site_id' => $this->selectedSite,
                ]);

                $scheduledUser->refresh(); // データベースから最新の情報を取得

                if (is_null($scheduledUser->id)) {
                    throw new \Exception('ScheduledUser ID is null after creation.');
                }

                Log::info('ScheduledUser ID created: ', ['scheduledUser_id' => $scheduledUser->id]);

                // ScheduledUserRoleにデータを保存
                // $this->createScheduledUserRole($scheduledUser);//ここを消去するとうまく保存できる
            } catch (\Exception $e) {
                Log::error('Error creating ScheduledUser for employeeId: ' . $employeeId, ['error' => $e->getMessage()]);
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
                    throw new \Exception('ScheduledUser not found after creation.');
                }
            } catch (\Exception $e) {
                Log::error('Error creating ScheduledUserRole for employeeId: ' . $employeeId, ['error' => $e->getMessage()]);
            }
        }
    }

    protected function createScheduledUserRole($scheduledUser)
    {
        try {
            ScheduledUserRole::create([
                'scheduled_user_id' => $scheduledUser->id,
                'is_actual' => true,
                'is_scheduled' => false,
            ]);

            Log::info('ScheduledUserRole created for ScheduledUser ID: ' . $scheduledUser->id);
        } catch (\Exception $e) {
            Log::error('Error creating ScheduledUserRole for ScheduledUser ID: ' . $scheduledUser->id, ['error' => $e->getMessage()]);
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
