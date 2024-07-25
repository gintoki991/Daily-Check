<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmployeeList extends Component
{
    public $employees;
    public $editingEmployee = null;
    public $confirmingEmployeeDeletion = false;
    public $employeeToDelete;

    public $editBelongTo;
    public $editName;
    public $editEmail;

    public function mount()
    {
        $this->employees = User::all();
    }

    public function edit($id)
    {
        $this->editingEmployee = User::findOrFail($id);
        $this->editBelongTo = $this->editingEmployee->belong_to;
        $this->editName = $this->editingEmployee->name;
        $this->editEmail = $this->editingEmployee->email;
    }

    public function save()
    {
        $this->validate([
            'editBelongTo' => 'required|string|max:255',
            'editName' => 'required|string|max:255',
            'editEmail' => 'required|string|email|max:255|unique:users,email,' . $this->editingEmployee->id,
        ]);

        $this->editingEmployee->update([
            'belong_to' => $this->editBelongTo,
            'name' => $this->editName,
            'email' => $this->editEmail,
        ]);

        $this->editingEmployee = null;
        $this->mount();  // Refresh the list
        session()->flash('message', '従業員情報が更新されました。');
    }

    public function confirmDelete($id)
    {
        $this->confirmingEmployeeDeletion = true;
        $this->employeeToDelete = User::findOrFail($id);
    }

    public function delete()
    {
        $this->employeeToDelete->delete();
        $this->confirmingEmployeeDeletion = false;
        $this->mount();  // Refresh the list
        session()->flash('message', '従業員が削除されました。');
    }

    public function cancelDelete()
    {
        $this->confirmingEmployeeDeletion = false;
    }

    public function cancelEdit()
    {
        $this->editingEmployee = null;
    }

    public function render()
    {
        return view('livewire.employee-list');
    }
}
