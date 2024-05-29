<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class EmployeeList extends Component
{
    public $employees;

    public function mount()
    {
        $this->employees = User::all();
    }

    public function render()
    {
        return view('livewire.employee-list');
    }
}
