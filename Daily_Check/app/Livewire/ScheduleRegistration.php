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
            // バリデーションエラーはsession()->flashではなく、自動的にエラーメッセージが表示される
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

                // まずはScheduledUserを作成
                $scheduledUser = ScheduledUser::firstOrCreate([
                    'scheduled_id' => $this->scheduled_id,
                    'user_id' => $employeeId,
                    'site_id' => $this->selectedSite,
                ]);

                $scheduledUser->refresh(); // データベースから最新の情報を取得
                $this->scheduledUser_id = $scheduledUser->id;

                if ($this->scheduledUser_id === null) {
                    throw new \Exception('ScheduledUser ID is null after creation.');
                }

                Log::info('ScheduledUser ID created: ', ['scheduledUser_id' => $this->scheduledUser_id]);

                // `ScheduledUserRole`に`is_scheduled`が`1`のレコードがあるか確認
                $existingRole = ScheduledUserRole::where('scheduled_user_id', $scheduledUser->id)
                    ->where('is_scheduled', true)
                    ->first();

                if ($existingRole) {
                    // 既に`is_scheduled`が`1`のレコードが存在する場合は、重複として処理
                    $this->duplicateEntries[] = User::find($employeeId)->name;
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

    //ScheduledUserRoleにデータを保存
    protected function createScheduledUserRole($scheduledUser)
    {
        ScheduledUserRole::create([
            'scheduled_user_id' => $scheduledUser->id,
            'is_actual' => false,
            'is_scheduled' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.schedule-registration', [
            'sites' => $this->sites,
            'employees' => $this->employees,
        ])->layout('daily-check.workers_arrangement');
    }
}
