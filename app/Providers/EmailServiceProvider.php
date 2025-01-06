<?php

namespace App\Providers;

use Ichtrojan\Otp\Otp;
use App\Notifications\VerifyEmail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
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

    ResetPassword::toMailUsing(function (object $notifiable, string $otp) {
      return (new MailMessage())
        ->subject('Reset Password')
        ->greeting('Dear ' . $notifiable->first_name . ',')
        ->line('You are receiving this email because we received a password reset request for your account.')
        ->line('Please use the following OTP (One-Time Password) to reset your password:')
        ->line($otp)
        ->line('If you did not request a password reset, no further action is required.');
    });

    ResetPassword::createUrlUsing(function (object $notifiable) {
      return (new Otp())->generate($notifiable->email, 'numeric', 5, 10)->token;
    });
  }
}
