<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Requests\Api\UpdateProfilePictureRequest;

class ProfileController extends Controller
{
  /**
   * Show the resource.
   */
  public function show(Request $request)
  {
    $request->withToken(false);

    return response()->json([
      ...LoginResource::make($request->user())->response()->getData(true),
    ]);
  }

  /**
   * Update the resource in storage.
   */
  public function update(UpdateProfileRequest $request)
  {
    $request->user()->update($request->validated());

    $request->withToken(false);

    return response()->json([
      'message' => 'Profile successfully updated.',
      ...LoginResource::make($request->user())->response()->getData(true),
    ]);
  }

  /**
   * Remove the resource from storage.
   */
  public function destroy(Request $request)
  {
    $request->user()->delete();

    return response()->json([
      'message' => 'Account successfully deleted.',
    ]);
  }

  /**
   * Update profile picture.
   */
  public function updateProfilePicture(UpdateProfilePictureRequest $request)
  {
    $request->user()->addMedia($request->file('avatar'))
      ->toMediaCollection($request->user()::AVATAR);

    $request->withToken(false);

    return response()->json([
      'message' => 'Profile picture successfully updated.',
      ...LoginResource::make($request->user())->response()->getData(true),
    ]);
  }
}
