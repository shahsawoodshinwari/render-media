<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Member;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Notifications\ResetPasswordNotification;
use App\Http\Requests\Api\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
  public function sendResetLinkEmail(ForgotPasswordRequest $request)
  {
    $member = Member::whereEmail($request->get('email'));
    if ($member->doesntExist()) {
      throw ValidationException::withMessages([
        'email' => __('passwords.user'),
      ]);
    }

    $member = $member->first();
    $notifiable = (object) $member->toArray();
    $otp = call_user_func(
      ResetPasswordNotification::$createUrlCallback,
      $notifiable
    );

    $member->sendPasswordResetNotification($otp);

    $email = Str::mask($member->email, '*', 3, -3);

    return response()->json([
      'message' => "We sent a 5-digit verification code to $email",
    ]);
  }
}
