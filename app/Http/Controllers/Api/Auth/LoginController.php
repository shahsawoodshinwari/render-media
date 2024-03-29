<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LoginResource;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  public function login(LoginRequest $request)
  {
    if (Auth::guard('members')->attempt($request->only('email', 'password'), $request->remember)) {

      return response()->json(
        LoginResource::make(Auth::guard('members')->user())
          ->response()
          ->getData(true)
      );
    }

    throw ValidationException::withMessages([
      'email' => [__('auth.failed')],
    ]);
  }
}
