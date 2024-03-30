<?php

namespace App\Providers;

use Ichtrojan\Otp\Otp;
use App\Notifications\VerifyEmail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class EmailServiceProvider extends ServiceProvider
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
    VerifyEmail::toMailUsing(function (object $notifiable, string $otp) {
      return (new MailMessage())
        ->subject('Verify Email Address')
        ->greeting('Dear ' . $notifiable->first_name . ',')
        ->line('Thank you for signing up for our service. To complete your registration, please use the following OTP (One-Time Password) to verify your email address:')
        ->line($otp)
        ->line('Please enter this OTP on the verification page to activate your account. This OTP will expire in 10 minutes. If you did not sign up for our service, please disregard this email.');
    });

    VerifyEmail::createUrlUsing(function (object $notifiable) {
      return (new Otp())->generate($notifiable->email, 'numeric', 5, 10)->token;
    });
  }
}
