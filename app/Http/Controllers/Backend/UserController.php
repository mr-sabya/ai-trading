<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 
    public function index()
    {
        return view('backend.user.index');
    }

    // create
    public function create()
    {
        return view('backend.user.create');
    }

    // create
    public function edit($id)
    {
        $user = User::findOrFail(intval($id));
        return view('backend.user.edit', compact('user'));
    }
}
