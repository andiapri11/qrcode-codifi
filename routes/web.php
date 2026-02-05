<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\QrController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Basic Root Route
Route::get('/', function () {
    return view('welcome');
});

// Static Legal & Help Pages
Route::get('/help', function () { return view('legal.help'); })->name('help');
Route::get('/terms', function () { return view('legal.terms'); })->name('terms');
Route::get('/privacy', function () { return view('legal.privacy'); })->name('privacy');

// GET Logout to prevent 419 Page Expired
Route::get('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout.get');



// Google Socialite Routes (Throttled)
Route::group([], function () {
    Route::get('auth/google', [\App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);
});

// Onboarding Routes for Google Users (Session Based or Auth Based)
Route::middleware(['web'])->group(function () {
    Route::get('auth/onboarding', [\App\Http\Controllers\Auth\GoogleController::class, 'onboarding'])->name('auth.onboarding');
    Route::post('auth/onboarding', [\App\Http\Controllers\Auth\GoogleController::class, 'completeOnboarding'])->name('auth.onboarding.store');
});

// Midtrans Callback (Public - Heavily Throttled)
Route::post('/payments/midtrans/callback', [\App\Http\Controllers\Admin\SubscriptionController::class, 'callback']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Subscription & Payments (Explicitly OUTSIDE check.subscription for checkout)
    Route::get('/subscription', [\App\Http\Controllers\Admin\SubscriptionController::class, 'index'])->name('subscription.index');
    Route::post('/subscription/checkout', [\App\Http\Controllers\Admin\SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    Route::get('/subscription/success', [\App\Http\Controllers\Admin\SubscriptionController::class, 'success'])->name('subscription.success');
    Route::get('/subscription/transactions/{transaction}/invoice', [\App\Http\Controllers\Admin\SubscriptionController::class, 'showInvoice'])->name('subscription.transactions.invoice');
    Route::delete('/subscription/transactions/{transaction}', [\App\Http\Controllers\Admin\SubscriptionController::class, 'destroyTransaction'])->name('subscription.transactions.destroy');

    Route::middleware(['check.subscription'])->group(function () {
        // School Management
        Route::resource('schools', SchoolController::class);
        Route::post('schools/{school}/toggle-status', [SchoolController::class, 'toggleStatus'])->name('schools.toggle-status');

        // Links / QR Generator
        Route::get('/links', [LinkController::class, 'index'])->name('links.index');
        Route::get('/links/create', [LinkController::class, 'create'])->name('links.create');
        Route::post('/links', [LinkController::class, 'store'])->name('links.store');
        Route::post('/links/bulk-delete', [LinkController::class, 'bulkDelete'])->name('links.bulk-delete');
        Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');
        
        // QR Code Image Generator
        Route::get('/qr/generate', [QrController::class, 'generate'])->name('qr.generate');
        
        // AJAX Logo Upload
        Route::post('/logo/upload', [LogoController::class, 'upload'])->name('logo.upload');

        // Admin Account & User Management
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

        // Partner Management
        Route::get('/partners', [\App\Http\Controllers\Admin\PartnerController::class, 'index'])->name('partners.index');
        Route::post('/partners', [\App\Http\Controllers\Admin\PartnerController::class, 'store'])->name('partners.store');
        Route::put('/partners/{user}', [\App\Http\Controllers\Admin\PartnerController::class, 'update'])->name('partners.update');
        Route::delete('/partners/{user}', [\App\Http\Controllers\Admin\PartnerController::class, 'destroy'])->name('partners.destroy');

        // System Settings (Placeholder)
        Route::get('/settings', function() {
            return view('admin.settings', ['title' => 'Pengaturan Sistem']);
        })->name('admin.settings');
        
        Route::post('/settings', function() {
            return back()->with('success', 'Pengaturan placeholder berhasil disimpan (simulasi).');
        });
    });
});

require __DIR__.'/auth.php';
