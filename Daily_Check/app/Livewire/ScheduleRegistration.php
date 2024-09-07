<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Site;
use App\Models\User;
use App\Models\Scheduled;
use App\Models\ScheduledUser;
use App\Models\ScheduledUserRole;
use Illuminate\Validation\ValidationException;

class ScheduleRegistration extends Component
{
    public $sites;
    public $employees;
    public $selectedDate;
    public $selectedSite;
    public $selectedEmployees = [];
    public $duplicateEntries = [];
    public $scheduled_id;

    protected $rules = [
        'selectedDate' => 'required|date',
        'selectedSite' => 'required|exists:sites,id',
        'selectedEmployees' => 'required|array',
        'selectedEmployees.*' => 'exists:users,id',
    ];

    public function mount()
    {
        $this->sites = Site::all();
        $this->employees = User::all();
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function selectDate($date)
    {
        $this->selectedDate = $date;
    }

    public function submit()
    {
        DB::beginTransaction();
        try {
            Log::info('バリデーション開始');
            $validated = $this->validate();
            Log::info('バリデーション成功: ', $validated);

            // 日付に基づいてScheduledエントリを取得または作成
            $scheduled = Scheduled::firstOrCreate(['date' => $this->selectedDate]);
            $this->scheduled_id = $scheduled->id;

            Log::info('Scheduled ID: ', ['scheduled_id' => $this->scheduled_id]);

            // 1. 全ての ScheduledUser をトランザクション内で作成
            $this->createAllScheduledUsers();

            DB::commit();

            // 2. トランザクション外で ScheduledUserRole を一度に作成
            $this->createAllScheduledUserRoles();

            if (!empty($this->duplicateEntries)) {
                session()->flash('error', '以下のユーザーはすでに登録されています: ' . implode(', ', $this->duplicateEntries));
            } else {
                session()->flash('message', '登録が成功しました！');
            }
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error('バリデーションエラー: ' . json_encode($e->errors()));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('データの保存に失敗しました: ' . $e->getMessage());
            session()->flash('error', 'データの保存に失敗しました: ' . $e->getMessage());
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

                // `ScheduledUser` を作成
                $scheduledUser = ScheduledUser::firstOrCreate([
                    'scheduled_id' => $this->scheduled_id,
                    'user_id' => $employeeId,
                    'site_id' => $this->selectedSite,
                ]);

                if ($scheduledUser->wasRecentlyCreated) {
                    Log::info('ScheduledUser ID created: ', ['scheduledUser_id' => $scheduledUser->id]);
                } else {
                    // 既に存在する場合、`scheduled_user_roles` テーブルを確認
                    $existingRole = ScheduledUserRole::where('scheduled_user_id', $scheduledUser->id)
                        ->where('is_scheduled', true)
                        ->first();

                    if ($existingRole) {
                        $this->duplicateEntries[] = User::find($employeeId)->name;
                        continue; // 次のループに進む
                    }
                }
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
        // 重複チェック: 既に `is_scheduled` が `1` のレコードが存在するか確認
        $existingRole = ScheduledUserRole::where('scheduled_user_id', $scheduledUser->id)
            ->where('is_scheduled', true)
            ->first();

        if (!$existingRole) {
            ScheduledUserRole::create([
                'scheduled_user_id' => $scheduledUser->id,
                'is_scheduled' => true,
            ]);
        } else {
            Log::info('ScheduledUserRole already exists for ScheduledUser ID:', ['scheduled_user_id' => $scheduledUser->id]);
        }
    }

    public function render()
    {
        return view('livewire.schedule-registration', [
            'sites' => $this->sites,
            'employees' => $this->employees,
        ])->layout('daily-check.workers_arrangement');
    }
}
