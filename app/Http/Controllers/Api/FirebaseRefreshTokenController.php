<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\CreateOrUpdateFirebaseTokenEvent;

class FirebaseRefreshTokenController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $this->validate($request, [
      'old_fcm_token' => ['required'],
      'new_fcm_token' => ['required'],
    ]);

    event(new CreateOrUpdateFirebaseTokenEvent(auth()->user(), $request->input('new_fcm_token'), $request->input('old_fcm_token')));

    return response()->json([
      'message' => 'Firebase token successfully updated.',
    ]);
  }
}
