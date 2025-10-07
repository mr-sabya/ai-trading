<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            // If authenticated, redirect them to the dashboard
            return redirect()->route('dashboard.index')->send();
        }
    }

    // show register page
    public function register()
    {
        return view('frontend.auth.register');
    }

    // show login page
    public function login()
    {
        return view('frontend.auth.login');
    }
}
