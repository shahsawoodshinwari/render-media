<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\PasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationController;

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('email/resend', [VerificationController::class, 'resend']);
  Route::post('email/verify', [VerificationController::class, 'verify']);

  Route::middleware('verified')->group(function () {
    Route::post('update-password', PasswordController::class);

    Route::apiResource('bookings', BookingController::class)->only(['index', 'store']);
    Route::apiResource('categories', CategoryController::class)->only('index');
  });
});
