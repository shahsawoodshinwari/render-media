<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\ChangePasswordRequest;
use App\Notifications\PasswordChangedNotification;

class MemberPasswordController extends Controller
{
  public function edit(Member $member)
  {
    return view('members.password.edit', compact('member'));
  }

  public function update(ChangePasswordRequest $request, Member $member)
  {
    $member->updatePassword($request->password);

    $member->notify(new PasswordChangedNotification());

    return redirect()->route('members.index')->withSuccess('Password has been updated.');
  }
}
