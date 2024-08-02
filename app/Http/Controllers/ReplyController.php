<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Ticket $ticket)
  {
    sleep(1);

    $ticket->load(['replies' => fn ($query) => $query->latest('created_at')]);

    return response()->json(view('components.tickets.chats', compact('ticket'))->render());
  }
}
