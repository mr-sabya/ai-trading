<?php

use Illuminate\Support\Facades\Route;



// frontend routes
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home.index');