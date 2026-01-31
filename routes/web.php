<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\QrController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect root to dashboard/login
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // School Management
    Route::resource('schools', SchoolController::class);



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

    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
