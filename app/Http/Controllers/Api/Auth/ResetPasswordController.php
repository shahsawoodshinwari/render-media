<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Member;
use Ichtrojan\Otp\Otp;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
  public function reset(ResetPasswordRequest $request)
  {
    $member = Member::whereEmail($request->email);

    if ($member->doesntExist()) {
      throw ValidationException::withMessages(['email' => __('passwords.user')]);
    }

    if (!(new Otp())->validate($request->email, $request->token)->status) {
      throw ValidationException::withMessages(['token' => __('passwords.token')]);
    }

    $member = $member->first();

    $member->updatePassword($request->password);

    return response()->json([
      'message' => 'Your password has been successfully reset, click below to continue your access.',
      'data' => LoginResource::make($member),
    ]);
  }
}
