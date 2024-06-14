<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CMS\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MemberPasswordController;
use App\Http\Controllers\FreelancerStatusController;
use App\Http\Controllers\MemberVerificationController;
use App\Http\Controllers\MemberProfilePictureController;

Auth::routes(['verify' => true]);

Route::get('generate-slug', fn(Request $request) => response()->json([
  'slug' => Str::slug($request->text),
]));

Route::middleware('auth')->group(function () {
  Route::get('/', DashboardController::class)->name('dashboard');

  Route::patch('resend-verification/{member}', [MemberVerificationController::class, 'resend'])->name('members.resend-verification');
  Route::patch('verify/{member}', [MemberVerificationController::class, 'verify'])->name('members.verify');

  Route::post('freelancers/{freelancer}/status', FreelancerStatusController::class)->name('freelancers.status');

  Route::get('cms/pages/{page}', [PageController::class, 'show'])->name('cms.pages.show');
  Route::put('cms/pages/{page}', [PageController::class, 'update'])->name('cms.pages.update');

  Route::resource('categories', CategoryController::class)->except(['show']);
  Route::resource('freelancers', FreelancerController::class)->except(['show']);
  Route::resource('members', MemberController::class);
  Route::singleton('members.password', MemberPasswordController::class)->only(['edit', 'update']);
  Route::singleton('members.profile-picture', MemberProfilePictureController::class)->only('update');
  Route::singleton('profile', ProfileController::class)->only(['show', 'edit', 'update']);
  Route::resource('categories.sub-categories', SubCategoryController::class)->except(['show'])->shallow();
});
