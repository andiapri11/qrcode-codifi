<?php

use App\Http\Controllers\Api\HandshakeController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/verify-exam', [HandshakeController::class, 'verify']);
Route::post('/v1/school-branding', [HandshakeController::class, 'fetchBranding']);
