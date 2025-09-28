<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //
    public function index()
    {
        return view('backend.package.index');
    }

    // fearture 
    public function feature($id)
    {
        $package = Package::findOrFail(intval($id));
        return view('backend.package.feature', compact('package'));
    }
}
