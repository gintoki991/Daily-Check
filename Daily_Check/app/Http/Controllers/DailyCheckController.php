<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyCheckController extends Controller
{
    public function showLogin() {
        return view('/daily-check/login');
    }

    public function showHome()
    {
        return view('/daily-check/home');
    }
}
