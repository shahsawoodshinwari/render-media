<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class SuperAdminDBNotification extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(
    public ?Model $model,
    public ?string $message = null
  ) {
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['database'];
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      'message' => $this->message ?: 'Super Admin DB Notification',
      'type'    => $this->model ? strtolower(class_basename($this->model)) : null,
      'extra'   => ['model' => $this->model],
    ];
  }
}
