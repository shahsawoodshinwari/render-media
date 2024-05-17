<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class MigrationServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    Blueprint::macro('firstName', fn($column = null) => $this->string($column ?: 'first_name'));
    Blueprint::macro('lastName', fn($column = null) => $this->string($column ?: 'last_name'));
    Blueprint::macro('phone', fn($column = null) => $this->string($column ?: 'phone'));
  }
}
