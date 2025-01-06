<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Member;
use Ichtrojan\Otp\Otp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\LoginResource;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\URL;

class ResetPasswordController extends Controller
{
  public function reset(ResetPasswordRequest $request)
  {
    $member = Member::whereEmail($request->email);

    if ($member->doesntExist()) {
      throw ValidationException::withMessages(['email' => __('passwords.user')]);
    }

    //if (!(new Otp())->validate($request->email, $request->token)->status) {
    //  throw ValidationException::withMessages(['token' => __('passwords.token')]);
    //}

    $member = $member->first();

    $member->updatePassword($request->password);

    return response()->json([
      'message' => 'Your password has been successfully reset, click below to continue your access.',
      'data' => LoginResource::make($member),
    ]);
  }

  public function verifyOtp(Request $request, Otp $otp)
  {
    $request->validate([
      'email' => 'required|email|exists:members,email',
      'token' => 'required|numeric',
    ]);

    if (!$otp->validate($request->email, $request->token)->status) {
      throw ValidationException::withMessages(['token' => __('passwords.token')]);
    }

    $signature = explode('=', parse_url(URL::signedRoute('api.password.reset'), PHP_URL_QUERY))[1];

    return response()->json(['message' => 'Your otp has been verified', 'signature' => $signature]);
  }
}
