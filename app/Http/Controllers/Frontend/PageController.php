<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // service page
    public function service()
    {
        return view('frontend.service.index');
    }

    // about page
    public function about()
    {
        return view('frontend.about.index');
    }

    // package page
    public function package()
    {
        return view('frontend.packages.index');
    }

    // contact page
    public function contact()
    {
        return view('frontend.contact.index');
    }
}
