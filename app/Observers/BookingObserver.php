<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Booking;
use App\Enums\Booking\RequestStatusEnum;
use App\Notifications\SuperAdminDBNotification;
use App\Notifications\BookingCreatedNotification;
use App\Notifications\BookingPendingNotification;
use App\Notifications\BookingAcceptedNotification;
use App\Notifications\BookingCancelledNotification;
use App\Notifications\BookingCompletedNotification;
use App\Notifications\BookingRescheduledNotification;

class BookingObserver
{
  /**
   * Handle the Booking "created" event.
   */
  public function created(Booking $booking): void
  {
    if ($booking->member) {
      $booking->member->notify(new BookingCreatedNotification($booking));
    }

    // Notify Admins as well
    $admins = User::get();
    if ($admins->isNotEmpty()) {
      $admins->each(fn($admin) => $admin->notify(new SuperAdminDBNotification($booking)));
    }
  }

  /**
   * Handle the Booking "updated" event.
   */
  public function updated(Booking $booking): void
  {
    // if request_status is changed
    if ($booking->isDirty('request_status')) {
      // If status is changed to pending, dispatch email
      if ($booking->request_status == RequestStatusEnum::PENDING) {
        $booking->member->notify(new BookingPendingNotification($booking));
      } elseif ($booking->request_status == RequestStatusEnum::ACCEPTED) {
        $booking->member->notify(new BookingAcceptedNotification($booking));
      } elseif ($booking->request_status == RequestStatusEnum::CANCELLED) {
        $booking->member->notify(new BookingCancelledNotification($booking));
      } elseif ($booking->request_status == RequestStatusEnum::COMPLETED) {
        $booking->member->notify(new BookingCompletedNotification($booking));
      } elseif ($booking->request_status == RequestStatusEnum::RESCHEDULED) {
        $booking->member->notify(new BookingRescheduledNotification($booking));
      }
    }
  }

  /**
   * Handle the Booking "deleted" event.
   */
  public function deleted(Booking $booking): void
  {
    //
  }

  /**
   * Handle the Booking "restored" event.
   */
  public function restored(Booking $booking): void
  {
    //
  }

  /**
   * Handle the Booking "force deleted" event.
   */
  public function forceDeleted(Booking $booking): void
  {
    //
  }
}
