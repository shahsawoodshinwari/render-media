<?php

namespace App\Providers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Enums\TicketStatusEnum;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Password::defaults(function () {
      $rule = Password::min(8);

      return app()->isProduction()
        ? $rule->min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()
        : $rule;
    });

    Request::macro(
      'withToken',
      fn(bool $withToken = true) => Request::instance()->merge(['withToken' => $withToken])
    );

    View::share(
      'members',
      Member::whereHas('tickets')
        ->withCount([
          'tickets as number_of_open_tickets' => fn($query) => $query->whereStatus(TicketStatusEnum::OPEN->value),
          'tickets as number_of_closed_tickets' => fn($query) => $query->whereStatus(TicketStatusEnum::CLOSED->value),
        ])
        ->with(['avatar'])
        ->get()
    );
  }
}
