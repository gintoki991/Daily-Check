<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Site;
use App\Models\User;
use App\Models\Scheduled;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ScheduleRegistration extends Component
{
    public $sites;
    public $employees;
    public $selectedDate;
    public $selectedSite;
    public $selectedEmployees = [];

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
        // dd($this);

        DB::beginTransaction();

        try {
            foreach ($this->selectedEmployees as $employeeId) {
                Scheduled::create([
                    'date' => $this->selectedDate,
                    'user_id' => $employeeId,
                    'site_id' => $this->selectedSite,
                    'is_scheduled' => true,
                    'is_actual' => false,
                ]);
            }

            DB::commit();
            session()->flash('message', '登録が成功しました！');
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
