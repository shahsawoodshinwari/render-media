<?php

namespace App\Enums\Booking;

use App\Traits\EnumFormatTrait;

enum RequestStatusEnum: string
{
  use EnumFormatTrait;

  case PENDING   = 'Pending';
  case ACCEPTED  = 'Accepted';
  case REJECTED  = 'Rejected';
  case CANCELLED = 'Cancelled';
  case RESCHEDULED = 'Rescheduled';
}
