<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Observers\TicketObserver;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Ticket $ticket)
  {
    $request->validate([
      'message' => ['required', 'string', 'max:1000'],
    ]);

    $reply = $ticket->replies()->create([
      'content'     => $request->get('message'),
      'author_id'   => auth()->id(),
      'author_type' => Member::class,
    ]);

    (new TicketObserver)->userMessageSent($ticket, $reply);

    return response()->json([
      'message' => __('Your message has been sent.'),
    ]);
  }
}
