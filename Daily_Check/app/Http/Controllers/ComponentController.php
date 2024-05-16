<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function showLogin() {
        return view('/components/daily-check/login');
    }

    public function showHome()
    {
        return view('/components/daily-check/home');
    }
}
