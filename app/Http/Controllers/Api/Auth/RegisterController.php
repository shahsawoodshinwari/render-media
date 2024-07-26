<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\CreateOrUpdateFirebaseTokenEvent;
use App\Models\Member;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use App\Http\Requests\Api\Auth\RegisterRequest;

class RegisterController extends Controller
{
  public function register(RegisterRequest $request)
  {
    $member = Member::create($request->validated());
    $member->sendEmailVerificationNotification();

    // Create or Update Firebase Token
    event(new CreateOrUpdateFirebaseTokenEvent($member, $request->new_fcm_token, $request->old_fcm_token));

    return response()->json(
      LoginResource::make($member)
        ->response()
        ->getData(true),
      201
    );
  }
}
