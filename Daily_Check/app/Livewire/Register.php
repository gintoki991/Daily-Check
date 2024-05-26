<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    #[Validate('required|string|max:255')]
    public $belong_to = '';
    #[Validate('required|string|max:255')]
    public $name = '';
    #[Validate('required|string|email|max:255|unique:users')]
    public $email = '';
    #[Validate('required|string|min:8')]
    public $password = '';

    public function register()
    {
        $this->validate();

        // dd($this);

        User::create([
            'belong_to' => $this->belong_to,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }

    public function render()
    {

        return view('livewire.register')->layout('daily-check.register');
    }
}
