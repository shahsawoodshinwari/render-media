<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingCompletedNotification extends Notification
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
    return (new MailMessage())
      ->subject('Booking Completed')
      ->greeting('Hello, ' . $notifiable->first_name . '!')
      ->line('Your booking with reference #' . $this->booking->booking_id)
      ->line('has been completed.')
      ->line('Thank you for using our application!');
  }
}
