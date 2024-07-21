<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class EmployeeRegistration extends Component
{
    #[Validate('required|string|max:255')]
    public $belong_to = '';
    #[Validate('required|string|max:255')]
    public $name = '';
    #[Validate('required|string|email|max:255|unique:users')]
    public $email = '';
    #[Validate('required|string|min:8')]
    public $password = '';

    public function employeeStore()
    {
        DB::beginTransaction();
        try {
            Log::info('バリデーション開始');
            $validated = $this->validate();
            Log::info('バリデーション成功: ', $validated);

            // パスワードのハッシュ化
            $hashedPassword = Hash::make($this->password);

            // usersテーブルにデータを保存
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $hashedPassword,
                'belong_to' => $this->belong_to,
            ]);

            DB::commit();
            session()->flash('success', 'ユーザーが正常に登録されました。');
            $this->reset(['belong_to', 'name', 'email', 'password']);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error('バリデーションエラー: ' . json_encode($e->errors()));
            session()->flash('error', 'バリデーションエラーが発生しました。');
            $this->resetErrorBag();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('データの保存に失敗しました: ' . $e->getMessage());
            session()->flash('error', 'データの保存に失敗しました: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.employee-registration')->layout('daily-check.employee_management');
    }
}
