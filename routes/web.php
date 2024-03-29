<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->group(function () {
  Route::get('/', DashboardController::class)->name('dashboard');
});

Auth::routes(['verify' => true]);
