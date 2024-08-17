<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Site;
use App\Models\User;
use App\Models\Scheduled;
use App\Models\ScheduledUser;
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
            $scheduled = Scheduled::firstOrCreate(['date' => $this->selectedDate]);

            $this->duplicateEntries = [];

            foreach ($this->selectedEmployees as $employeeId) {
                $existingEntry = ScheduledUser::where('scheduled_id', $scheduled->id)
                    ->where('user_id', $employeeId)
                    ->first();

                if ($existingEntry) {
                    // 重複する場合、個別のエラーメッセージを設定
                    session()->flash('error', 'ユーザー ' . User::find($employeeId)->name . ' はすでにこの日に登録されています。');
                } else {
                    ScheduledUser::create([
                        'scheduled_id' => $scheduled->id,
                        'user_id' => $employeeId,
                        'site_id' => $this->selectedSite,
                        'is_scheduled' => true,
                        'is_actual' => false,
                    ]);
                }
            }

            DB::commit();

            // 重複があった場合は成功メッセージを表示しない
            if (empty($this->duplicateEntries)) {
                session()->flash('message', '登録が成功しました！');
            }
        } catch (ValidationException $e) {
            DB::rollBack();
            session()->flash('error', 'バリデーションエラーが発生しました。');
        } catch (\Exception $e) {
            DB::rollBack();
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

