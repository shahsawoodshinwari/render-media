<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMemberRequest;

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
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Member $member)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Member $member)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Member $member)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Member $member)
  {
    //
  }
}