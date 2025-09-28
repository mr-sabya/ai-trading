<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    
    public function index()
    {
        return view('frontend.user.profile.index');
    }

    
    public function dashboard()
    {
        return view('frontend.user.dashboard.index');
    }

    // my package
    public function package()
    {
        return view('frontend.user.package.index');
    }
}
