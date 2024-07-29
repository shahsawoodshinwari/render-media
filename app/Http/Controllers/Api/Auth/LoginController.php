<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Enums\Auth\GuardEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LoginResource;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use App\Events\CreateOrUpdateFirebaseTokenEvent;

class LoginController extends Controller
{
  public function login(LoginRequest $request)
  {
    if (Auth::guard(GuardEnum::MEMBERS->value)->attempt($request->only('email', 'password'), $request->remember)) {

      event(new CreateOrUpdateFirebaseTokenEvent(Auth::guard(GuardEnum::MEMBERS->value)->user(), $request->new_fcm_token, $request->old_fcm_token));

      return response()->json(
        LoginResource::make(Auth::guard(GuardEnum::MEMBERS->value)->user())
          ->response()
          ->getData(true)
      );
    }

    throw ValidationException::withMessages([
      'email' => [__('auth.failed')],
    ]);
  }

  public function logout(Request $request)
  {
    Auth::guard(GuardEnum::MEMBERS)->logout();

    $request->user()->currentAccessToken()->delete();

    return response()->json([
      'message' => 'Successfully logged out',
    ]);
  }
}
