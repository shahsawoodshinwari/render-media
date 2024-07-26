<?php

namespace App\Listeners;

use App\Events\CreateOrUpdateFirebaseTokenEvent;
use App\Notifications\Channels\PushNotificationChannel;

class CreateOrUpdateFirebaseTokenEventListener
{
  public function handle(CreateOrUpdateFirebaseTokenEvent $event): void
  {
    if ($event->model !== null && $event->new_fcm_token !== null) {
      PushNotificationChannel::updateFirebaseToken($event->model, $event->new_fcm_token, $event->old_fcm_token);
    }
  }
}
