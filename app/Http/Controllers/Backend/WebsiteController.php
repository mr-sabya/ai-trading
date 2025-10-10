<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    //  banner
    public function banner()
    {
        return view('backend.website.banner');
    }

    // partner
    public function partner()
    {
        return view('backend.website.partner');
    }

    // about
    public function about()
    {
        return view('backend.website.about');
    }

    // website features
    public function features()
    {
        return view('backend.website.features');
    }

    // service
    public function service()
    {
        return view('backend.website.service');
    }

    // team members
    public function team()
    {
        return view('backend.website.team');
    }

    // testimonial
    public function testimonial()
    {
        return view('backend.website.testimonial');
    }

    // faq
    public function faq()
    {
        return view('backend.website.faq');
    }
}
