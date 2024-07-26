<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingRescheduledNotification extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(
    public ?Booking $booking
  ) {}

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage
  {
    $date = Carbon::parse($this->booking->date)->format('d/m/Y');
    $time = Carbon::parse($this->booking->time)->format('h:i A');
    return (new MailMessage())
      ->subject('Booking Rescheduled')
      ->greeting('Hello, ' . $notifiable->first_name . '!')
      ->line('Your booking with reference ' . $this->booking->booking_id)
      ->line('has been rescheduled.')
      ->line('Your new booking date & time is: ' . $date . ' | ' . $time)
      ->line('Thank you for using our application!');
  }
}
