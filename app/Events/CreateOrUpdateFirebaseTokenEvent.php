<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CreateOrUpdateFirebaseTokenEvent
{
  use Dispatchable;
  use SerializesModels;
  use InteractsWithSockets;

  public Model $model;
  public ?string $new_fcm_token;
  public ?string $old_fcm_token;

  public function __construct($model = null, $new_fcm_token = null, $old_fcm_token = null)
  {
    $this->model = $model;
    $this->new_fcm_token = $new_fcm_token;
    $this->old_fcm_token = $old_fcm_token;
  }
}
