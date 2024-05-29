<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Photo;
use App\Models\User;
use App\Models\Site;
use App\Models\Test;

class DailyCheckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function testCreate()
    {
        return view('/daily-check/test_creating');
    }
    public function testStore(Request $request)
    {
        try {
            // バリデーションルールを指定する
            $validated = $request->validate([
                'belong_to' => 'required|string|max:255',
                'name' => 'required|string|max:255',
            ]);

            // データを保存する
            Test::create([
                'belong_to' => $validated['belong_to'],
                'name' => $validated['name'],
            ]);

            session()->flash('message', 'Test created successfully.');
        } catch (ValidationException $e) {
            // バリデーションエラーメッセージを表示
            dd($e->errors());
        }
        return redirect()->route('test.create')->with('message', 'Test created successfully.');
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
        try {
            // バリデーションルールを指定する
            $validated = $request->validate([
                'site_name' => 'required|string|max:255',
            ]);

            // データを保存する
            Site::create([
                'name' => $validated['site_name'],
            ]);

            session()->flash('message', 'Site created successfully.');
        } catch (ValidationException $e) {
            // バリデーションエラーメッセージを表示
            dd($e->errors());
        }
        return redirect()->route('site.management')->with('status', 'Registration successful!');
    }

    public function showLogin()
    {
        return view('/daily-check/login');
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
