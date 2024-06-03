<?php

namespace App\Http\Controllers;

use App\Models\Member;

class MemberVerificationController extends Controller
{
  public function verify(Member $member)
  {
    $member->markEmailAsVerified();

    return redirect()->back()->withSuccess('Account has been verified.');
  }

  public function resend(Member $member)
  {
    $member->markEmailAsNotVerified();
    $member->sendEmailVerificationNotification();

    return redirect()->back()->withSuccess('Verification email has been sent.');
  }
}
