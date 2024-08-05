<?php

namespace App\Http\Controllers\Api;

use App\Enums\Auth\GuardEnum;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTicketRequest;
use App\Http\Resources\TicketDetailResource;
use App\Http\Resources\TicketListResource;
use App\Models\Member;
use App\Models\Ticket;
use App\Notifications\PushNotification;
use App\Observers\TicketObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $tickets = Ticket::latest()->get();

    return response()->json(TicketListResource::collection($tickets)->response()->getData(true));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreTicketRequest $request)
  {
    $ticket = auth()->user()->tickets()->create([
      'ticket_id' => Ticket::generateTicketId(),
      'status'    => TicketStatusEnum::OPEN,
      ...$request->validated(),
    ]);

    auth()->user()->notify(new PushNotification('New ticket', 'Thanks for submitting your request. Our team will get in touch with you shortly.'));

    return response()->json(TicketDetailResource::make($ticket));
  }

  /**
   * Display the specified resource.
   */
  public function show(Ticket $ticket)
  {
    abort_if($ticket->member_id != auth()->id(), 403, __('You can only view your own tickets.'));

    return response()->json(TicketDetailResource::make($ticket));
  }

  public function close(Request $request, Ticket $ticket)
  {
    abort_if($ticket->member_id != auth()->id(), 403, __('You can only close your own tickets.'));

    $ticket->update([
      'status'    => TicketStatusEnum::CLOSED,
      'closed_at' => now(),
    ]);

    (new TicketObserver)->closed($ticket);

    return response()->json(TicketDetailResource::make($ticket));
  }

  public function reopen(Request $request, Ticket $ticket)
  {
    abort_if($ticket->member_id != auth()->id(), 403, __('You can only reopen your own tickets.'));

    $request->validate([
      'reason' => ['required', 'max:1000'],
    ]);

    $ticket->update([
      'status'     => TicketStatusEnum::OPEN,
      'reopned_at' => now(),
    ]);

    $ticket->replies()->create([
      'content'     => $request->get('reason'),
      'author_id'   => auth()->user()->id,
      'author_type' => Member::class,
    ]);

    (new TicketObserver)->reopend($ticket);

    return response()->json(TicketDetailResource::make($ticket));
  }
}
