<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Site;
use App\Models\User;
use App\Models\Scheduled;
use App\Models\ScheduledUser;
use App\Models\ScheduledUserRole;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ScheduleRegistration extends Component
{
    public $sites;
    public $employees;
    public $selectedDate;
    public $selectedSite;
    public $selectedEmployees = [];
    public $duplicateEntries = [];

    protected $listeners = ['selectDate'];

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
        $this->validate([
            'selectedDate' => 'required|date',
            'selectedSite' => 'required|exists:sites,id',
            'selectedEmployees' => 'required|array',
            'selectedEmployees.*' => 'exists:users,id',
        ]);

        DB::beginTransaction();

        try {
            $this->duplicateEntries = []; // 重複エントリのリセット

            // 日付に基づいてScheduledエントリを取得または作成
            $scheduled = Scheduled::firstOrCreate(['date' => $this->selectedDate]);

            // 選択された従業員ごとにScheduledUserエントリを作成
            foreach ($this->selectedEmployees as $employeeId) {
                // 重複するエントリがないか確認
                $existingEntry = ScheduledUser::where('scheduled_id', $scheduled->id)
                    ->where('user_id', $employeeId)
                    ->where('site_id', $this->selectedSite)
                    ->first();

                if ($existingEntry) {
                    // 重複する場合、エラーメッセージ用に保持
                    $this->duplicateEntries[] = User::find($employeeId)->name;
                } else {
                    // ScheduledUserエントリを作成し、その結果を変数に代入
                    $scheduledUser = ScheduledUser::create([
                        'scheduled_id' => $scheduled->id,
                        'user_id' => $employeeId,
                        'site_id' => $this->selectedSite,
                    ]);

                    // $scheduledUserが作成され、IDが正しく取得できているか確認
                    if ($scheduledUser && $scheduledUser->id) {
                        // ScheduledUserRoleエントリを作成
                        ScheduledUserRole::create([
                            'scheduled_user_id' => $scheduledUser->id,
                            'is_scheduled' => true,
                            'is_actual' => false,
                        ]);
                    } else {
                        // エラー処理: ScheduledUserが作成されなかった場合
                        \Log::error('ScheduledUser could not be created:', [
                            'scheduled_id' => $scheduled->id,
                            'user_id' => $employeeId,
                            'site_id' => $this->selectedSite,
                        ]);
                        throw new \Exception('ScheduledUser could not be created.');
                    }
                }
            }

            if (!empty($this->duplicateEntries)) {
                session()->flash('error', '以下のユーザーはすでに登録されています: ' . implode(', ', $this->duplicateEntries));
            } else {
                session()->flash('message', '登録が成功しました！');
            }

            DB::commit();
        } catch (ValidationException $e) {
            DB::rollBack();
            session()->flash('error', 'バリデーションエラーが発生しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to save data:', [
                'error' => $e->getMessage(),
                'scheduled_id' => $scheduled->id,
                'user_id' => $employeeId,
                'site_id' => $this->selectedSite,
            ]);
            session()->flash('error', 'データの保存に失敗しました: ' . $e->getMessage());
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
