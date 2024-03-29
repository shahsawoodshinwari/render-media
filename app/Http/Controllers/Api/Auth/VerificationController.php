<?php

namespace App\Http\Controllers\Api\Auth;

use Ichtrojan\Otp\Otp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Api\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
  /**
   * Mark the authenticated user's email address as verified.
   *
   * @param  \App\Http\Requests\Api\EmailVerificationRequest  $request
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function verify(EmailVerificationRequest $request): JsonResponse
  {
    if ($request->user()->hasVerifiedEmail()) {
      return response()->json([
        'message' => 'Email already verified.',
      ], 202);
    }

    $response = (new Otp())->validate($request->user()->email, $request->code);

    if (! $response->status) {
      throw ValidationException::withMessages([
        'code' => 'The provided code is invalid.',
      ]);
    }

    if ($request->user()->markEmailAsVerified()) {
      event(new Verified($request->user()));
    }

    return response()->json([
      'message' => 'Email successfully verified.',
    ], 202);
  }

  /**
   * Resend the email verification notification.
   *
   * @param  \Illuminate\Http\Request  $request
   */
  public function resend(Request $request): JsonResponse
  {
    if ($request->user()->hasVerifiedEmail()) {
      return response()->api([
        'message' => 'Email already verified.',
      ]);
    }

    $request->user()->sendEmailVerificationNotification();

    return response()->json([
      'message' => 'We resent a 5-digit verification code to ' . Str::mask($request->user()->email, '*', 3, -3),
    ], 202);
  }
}
