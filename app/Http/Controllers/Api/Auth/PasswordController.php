<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\UpdatePasswordRequest;

class PasswordController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(UpdatePasswordRequest $request)
  {
    dd($request->all());
  }
}
