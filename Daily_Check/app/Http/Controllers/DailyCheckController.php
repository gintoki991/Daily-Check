<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Photo;
use App\Models\User;
use App\Models\Site;
use App\Livewire\Actions\Logout;

class DailyCheckController extends Controller
{
    public function edit($reportId)
    {
        return view('daily-check.report_editing', ['reportId' => $reportId]);
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function managerPage()
    {
        return view('/daily-check/manager_page');
    }

    public function create()
    {
        return view('/daily-check/register');
    }

    public function register(Request $request)
    {
        // dd($request, $request->name);
        $request->validate([
            'belong_to' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        User::create([
            'belong_to' => $request->belong_to,
            'name' => $request->name,
            'email' => $request->email, 'password' => Hash::make($request->input('password')),
        ]);
        return redirect()->route('create')->with('status', 'Registration successful!');
    }

    public function siteManagement()
    {
        return view('/daily-check/site_management');
    }

    public function siteStore(Request $request)
    {
        // バリデーションルールを指定する
        $validated = $request->validate([
            'site_name' => 'required|string|max:255|unique:sites,name',
        ], [
            'site_name.required' => '現場名を入力してください',
            'site_name.unique' => 'この現場名は既に登録されています',
        ]);

        try {
            // データを保存する
            Site::create([
                'name' => $validated['site_name'],
            ]);

            // 成功メッセージをセッションに保存
            session()->flash('message', '現場が正常に作成されました。');
            return redirect()->route('site.management')->with('status', 'Registration successful!');
        } catch (\Exception $e) {
            // エラーメッセージをセッションに保存
            session()->flash('error', '現場の作成に失敗しました。');
            return back()->withInput();
        }
    }

    public function showLogin()
    {
        return view('/daily-check/login');
    }

    public function logout()
    {
        $logoutAction = new Logout();
        $logoutAction(); // Logout クラスの __invoke メソッドを実行

        return redirect('/'); // ログアウト後のリダイレクト先を指定
    }

    public function showHome()
    {
        return view('/daily-check/home');
    }

    public function store()
    {
        return view('/daily-check/report-creating');
    }

    public function index()
    {
        return view('/daily-check/document');
    }

    public function photoView()
    {
        return view('/daily-check/photos');
    }

    public function showPhoto($id)
    {
        $photo = Photo::find($id);

        return view('/daily-check/photos/{photo}', compact('photo'));
    }
}
