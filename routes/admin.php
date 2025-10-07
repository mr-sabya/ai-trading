<?php

use Illuminate\Support\Facades\Route;


// login route
Route::get('/login', [App\Http\Controllers\Backend\AuthController::class, 'showLoginForm'])->name('login');

// add middleware to the route
Route::middleware(['admin'])->group(function () {
    // Admin Dashboard
    Route::get('/', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('dashboard');

    // add package index route
    Route::get('/packages', [App\Http\Controllers\Backend\PackageController::class, 'index'])->name('packages.index');
    // feature route
    Route::get('/packages/{package}/features', [App\Http\Controllers\Backend\PackageController::class, 'feature'])->name('packages.features');

    // ReferralGenerationController
    Route::get('/referral-generation', [App\Http\Controllers\Backend\ReferralGenerationController::class, 'index'])->name('referral-generation.index');

    // users
    Route::get('/users', [App\Http\Controllers\Backend\UserController::class, 'index'])->name('user.index');
    
    Route::get('/user/create', [App\Http\Controllers\Backend\UserController::class, 'create'])->name('user.create');
    
    Route::get('/user/{id}/edit', [App\Http\Controllers\Backend\UserController::class, 'edit'])->name('user.edit');
    
    // purchase
    Route::get('/purchase-list', [App\Http\Controllers\Backend\PurchaseController::class, 'index'])->name('purchase.index');

    Route::get('/purchase/{id}/show', [App\Http\Controllers\Backend\PurchaseController::class, 'show'])->name('purchase.show');

    // Settings group
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('site-info', [App\Http\Controllers\Backend\SettingController::class, 'siteInfo'])->name('site-info');
        Route::get('logos', [App\Http\Controllers\Backend\SettingController::class, 'logos'])->name('logos');
        Route::get('social-links', [App\Http\Controllers\Backend\SettingController::class, 'socialLinks'])->name('social-links');
        Route::get('seo', [App\Http\Controllers\Backend\SettingController::class, 'seo'])->name('seo');
        Route::get('additional', [App\Http\Controllers\Backend\SettingController::class, 'additional'])->name('additional');
    });

});
