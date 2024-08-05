<?php

namespace App\Observers;

use App\Models\Reply;
use App\Models\User;
use App\Models\Ticket;
use App\Notifications\PushNotification;
use App\Notifications\SuperAdminDBNotification;

class TicketObserver
{
  public function reopend(Ticket $ticket)
  {
    // Notify the user
    auth()->user()->notify(new PushNotification('Ticket reopend', 'Your ticket [#' . $ticket->ticket_id . '] has been reopend.'));

    // Notify admins
    $admins = User::get();
    if ($admins->isNotEmpty()) {
      $message = $ticket->member?->name . ' reopened thier ticket [#' . $ticket->ticket_id . '].';
      $admins->each(fn ($admin) => $admin->notify(new SuperAdminDBNotification($ticket, $message)));
    }
  }

  public function closed(Ticket $ticket)
  {
    // Notify the user
    auth()->user()->notify(new PushNotification('Ticket closed', 'Your ticket [#' . $ticket->ticket_id . '] has been closed.'));

    // Notify admins
    $admins = User::get();
    if ($admins->isNotEmpty()) {
      $message = $ticket->member?->name . ' closed thier ticket [#' . $ticket->ticket_id . '].';
      $admins->each(fn ($admin) => $admin->notify(new SuperAdminDBNotification($ticket, $message)));
    }
  }

  public function userMessageSent(Ticket $ticket, Reply $reply)
  {
    // Notify admins
    $admins = User::get();
    if ($admins->isNotEmpty()) {
      $message = $ticket->member?->name . ' sent a new message to thier ticket [#' . $ticket->ticket_id . '].';
      $admins->each(fn ($admin) => $admin->notify(new SuperAdminDBNotification($ticket, $message)));
    }
  }
}
