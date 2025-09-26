<?php

use Illuminate\Support\Facades\Route;


// login route
Route::get('/login', [App\Http\Controllers\Backend\AuthController::class, 'showLoginForm'])->name('login');

// add middleware to the route
Route::middleware(['admin'])->group(function () {
    // Admin Dashboard
    Route::get('/', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('dashboard');
});
