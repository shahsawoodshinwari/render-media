<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\MemberUpdateProfilePictureRequest;

class MemberProfilePictureController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function update(MemberUpdateProfilePictureRequest $request, Member $member)
  {
    $member->addMediaFromRequest('avatar')->toMediaCollection($member::AVATAR);

    return redirect()->route('members.show', $member)->with('success', 'Profile picture updated successfully.');
  }
}
