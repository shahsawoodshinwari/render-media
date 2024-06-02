<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

class MemberController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $members = Member::latest()->with(['avatar'])->get();

    return response()->view('members.index', compact('members'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return response()->view('members.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreMemberRequest $request)
  {
    Member::create($request->validated());

    return redirect()->route('members.index')->with('success', 'Member created successfully.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Member $member)
  {
    return response()->view('members.show', compact('member'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Member $member)
  {
    return response()->view('members.edit', compact('member'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateMemberRequest $request, Member $member)
  {
    $member->update($request->validated());

    return redirect()->route('members.index')->with('success', 'Member updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Member $member)
  {
    $member->delete();

    return redirect()->route('members.index');
  }
}
