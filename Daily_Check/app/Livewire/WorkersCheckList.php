<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Site;
use App\Models\User;
use App\Models\Scheduled;

class WorkersCheckList extends Component
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

        foreach ($this->selectedEmployees as $employeeId) {
            Scheduled::create([
                'year' => date('Y', strtotime($this->selectedDate)),
                'month' => date('m', strtotime($this->selectedDate)),
                'day' => date('d', strtotime($this->selectedDate)),
                'date' => $this->selectedDate,
                'user_id' => $employeeId,
                'site_id' => $this->selectedSite,
            ]);
        }

        session()->flash('message', '登録が成功しました！');
    }
    
    public function render()
    {
        return view('livewire.workers-check-list')->layout('daily-check.workers_arrangement');
    }
}
