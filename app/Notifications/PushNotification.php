<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Notifications\Channels\PushNotificationChannel;

class PushNotification extends Notification
{
  use Queueable;

  public function __construct(
    public $title,
    public $message,
    public $extra = [],
    public $tokens = null,
  ) {
  }

  public function via($notifiable)
  {
    $channels = ['database', PushNotificationChannel::class];

    return $channels;
  }

  public function tokens(object $notifiable)
  {
    return $this->tokens ?: $notifiable->fcmTokens;
  }

  public function toArray($notifiable)
  {
    return [
      'title'   => $this->title,
      'message' => $this->message,
      'extra'   => $this->extra,
    ];
  }
}
