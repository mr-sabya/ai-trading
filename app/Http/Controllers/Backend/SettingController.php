<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show the Site Info settings page
     */
    public function siteInfo()
    {
        return view('backend.settings.site-info');
    }

    /**
     * Show the Logos settings page
     */
    public function logos()
    {
        return view('backend.settings.logos');
    }

    /**
     * Show the Social Links settings page
     */
    public function socialLinks()
    {
        return view('backend.settings.social-links');
    }

    /**
     * Show the SEO settings page
     */
    public function seo()
    {
        return view('backend.settings.seo');
    }

    /**
     * Show the Additional settings page
     */
    public function additional()
    {
        return view('backend.settings.additional');
    }
}
