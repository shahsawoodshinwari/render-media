<?php

namespace App\Notifications\Channels;

use Illuminate\Support\Facades\Log;
use App\Traits\FirebaseMessagingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class PushNotificationChannel
{
  use FirebaseMessagingTrait;

  /**
   * Send the given notification.
   */
  public function send(Model $model, Notification $notification): void
  {
    $notificationData = $notification->toArray($model);
    $tokens = $notification->tokens($model);
    if ($tokens) {
      $response = $this->sendNotificationToMultipleDevices(
        $tokens,
        $notificationData['title'],
        $notificationData['message'],
        $notificationData['extra'] ?? [],
      );
      Log::channel('notifications')->info("Notification sent : " . json_encode($response));
    }
  }
}
