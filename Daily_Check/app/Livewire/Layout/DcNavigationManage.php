<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use App\Livewire\Actions\Logout; // Logout クラスをインポート

class DcNavigationManage extends Component
{
    public function logout()
    {
        $logoutAction = new Logout();
        $logoutAction(); // Logout クラスの __invoke メソッドを実行

        return redirect('/'); // ログアウト後のリダイレクト先を指定
    }

    public function render()
    {
        return view('livewire.layout.dc-navigation-manage');
    }
}
