<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CMS\FAQController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CMS\PageController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\FreelanerController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\Auth\PasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;

Route::name('api.')->group(function () {
  Route::post('login', [LoginController::class, 'login']);
  Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
  Route::post('password/reset', [ResetPasswordController::class, 'reset']);
  Route::post('register', [RegisterController::class, 'register']);
  Route::post('become-freelancer', FreelanerController::class);

  Route::resource('sub-categories', SubCategoryController::class)->only('index');

  Route::middleware('auth:sanctum')->group(function () {
    Route::post('email/resend', [VerificationController::class, 'resend']);
    Route::post('email/verify', [VerificationController::class, 'verify']);
    Route::post('logout', [LoginController::class, 'logout']);

    Route::middleware('verified')->group(function () {
      Route::post('update-password', PasswordController::class);
      Route::post('update-profile-picture', [ProfileController::class, 'updateProfilePicture']);
      Route::post('bookings/{booking}/reschedule', [BookingController::class, 'reschedule']);

      Route::singleton('profile', ProfileController::class)->destroyable()->only(['show', 'update', 'destroy']);

      Route::apiResource('bookings', BookingController::class)->only(['index', 'store']);
      Route::apiResource('contact-us', ContactUsController::class)->only('store');
      Route::apiResource('categories', CategoryController::class)->only('index');

      Route::prefix('cms')->group(function () {
        Route::apiResource('faqs', FAQController::class)->only('index');
        Route::apiResource('pages/{page}', PageController::class)->only('index');
      });
    });
  });
});
