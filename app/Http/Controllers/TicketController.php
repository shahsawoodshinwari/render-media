<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatusEnum;
use App\Models\Member;
use App\Models\Ticket;
use App\Notifications\PushNotification;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class TicketController extends Controller
{
  use ValidatesRequests;
  
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $member = null;
    if ($request->has('member') && !is_null($request->get('member'))) {
      $member = Member::whereHas('tickets')->where('id', $request->get('member'))->first();
      !is_null($member) ? $member->load(['tickets' => fn ($query) => $query->latest('updated_at')->filterByTab($request->get('tab'))]) : null;
    }

    return view('tickets.index', compact('member'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Ticket $ticket)
  {
    return view('tickets.show', compact('ticket'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Ticket $ticket)
  {
    $this->validate($request, [
      'message' => ['required', 'max:1000'],
    ]);

    $ticket->update([
      'closed_at' => now(),
      'status' => TicketStatusEnum::CLOSED,
    ]);

    if ($ticket->member) {
      $ticket->member->notify(new PushNotification('Ticket Closed', __('Your ticket has been closed.', ['message' => $request->get('message')])));
    }

    return redirect()->route('tickets.show', $ticket)->with('success', __('Ticket closed successfully'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Ticket $ticket)
  {
    //
  }
}
