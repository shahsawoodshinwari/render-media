<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberPasswordController;
use App\Http\Controllers\MemberProfilePictureController;
use App\Http\Controllers\MemberVerificationController;

Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function () {
  Route::get('/', DashboardController::class)->name('dashboard');

  Route::patch('resend-verification/{member}', [MemberVerificationController::class, 'resend'])->name('members.resend-verification');
  Route::patch('verify/{member}', [MemberVerificationController::class, 'verify'])->name('members.verify');
  
  Route::resource('members', MemberController::class);
  Route::singleton('members.password', MemberPasswordController::class)->only(['edit', 'update']);
  Route::singleton('members.profile-picture', MemberProfilePictureController::class)->only('update');
});
