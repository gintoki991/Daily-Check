<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Test;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TestCreating extends Component
{
    #[Validate('required|string|max:255')]
    public $belong_to = '';
    #[Validate('required|string|max:255')]
    public $name = '';

    public function register()
    {
        try {
            $this->validate();

            Test::create([
                'belong_to' => $this->belong_to,
                'name' => $this->name,
            ]);

            session()->flash('message', 'Test created successfully.');
        } catch (ValidationException $e) {
            dd($e->errors()); // ここでバリデーションエラーメッセージを表示
        }
    }

    public function render()
    {
        return view('livewire.test')->layout('daily-check.test_creating');
    }
}
