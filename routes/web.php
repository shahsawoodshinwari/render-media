<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\MemberPasswordController;
use App\Http\Controllers\FreelancerStatusController;
use App\Http\Controllers\MemberVerificationController;
use App\Http\Controllers\MemberProfilePictureController;

Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function () {
  Route::get('/', DashboardController::class)->name('dashboard');

  Route::patch('resend-verification/{member}', [MemberVerificationController::class, 'resend'])->name('members.resend-verification');
  Route::patch('verify/{member}', [MemberVerificationController::class, 'verify'])->name('members.verify');

  Route::post('freelancers/{freelancer}/status', FreelancerStatusController::class)->name('freelancers.status');
  Route::resource('freelancers', FreelancerController::class)->except(['show']);
  Route::singleton('profile', ProfileController::class)->only(['show', 'edit', 'update']);
  Route::resource('members', MemberController::class);
  Route::singleton('members.password', MemberPasswordController::class)->only(['edit', 'update']);
  Route::singleton('members.profile-picture', MemberProfilePictureController::class)->only('update');
});
