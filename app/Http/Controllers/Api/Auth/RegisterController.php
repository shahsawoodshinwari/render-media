<?php

namespace App\Http\Controllers\Api\Auth;

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

    return response()->json(
      LoginResource::make($member)
        ->response()
        ->getData(true),
      201
    );
  }
}
