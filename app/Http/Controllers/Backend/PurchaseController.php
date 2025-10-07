<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //
    public function index()
    {
        return view('backend.purchase.index');
    }
    
    // show
    public function show($id)
    {
        $purchase = Purchase::findOrFail(intval($id));
        return view('backend.purchase.show', compact('purchase'));

    }
}
