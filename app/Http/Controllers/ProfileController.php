<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    return view('profile.show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    return view('profile.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    return redirect()->route('profile.show', $user)->with('success', 'Profile updated.');
  }
}
