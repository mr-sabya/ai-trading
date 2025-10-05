<?php

use Illuminate\Support\Facades\Route;



// frontend routes
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home.index');

// service page
Route::get('/service', [App\Http\Controllers\Frontend\PageController::class, 'service'])->name('service.index');

// about page
Route::get('/about', [App\Http\Controllers\Frontend\PageController::class, 'about'])->name('about.index');

// package page
Route::get('/package', [App\Http\Controllers\Frontend\PageController::class, 'package'])->name('package.index');

// contact page
Route::get('/contact', [App\Http\Controllers\Frontend\PageController::class, 'contact'])->name('contact.index');

// show register page
Route::get('/singup', [App\Http\Controllers\Frontend\AuthController::class, 'register'])->name('register');

// show login page
Route::get('/login', [App\Http\Controllers\Frontend\AuthController::class, 'login'])->name('login');

// profile page
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Frontend\User\ProfileController::class, 'dashboard'])->name('dashboard.index');

    Route::get('/profile', [App\Http\Controllers\Frontend\User\ProfileController::class, 'index'])->name('profile.index');

    // package page
    Route::get('/user/package', [App\Http\Controllers\Frontend\User\ProfileController::class, 'package'])->name('profile.package');
    
    // checkout
    Route::get('/user/checkout/package/{id}', [App\Http\Controllers\Frontend\PageController::class, 'checkout'])->name('checkout.index');

});