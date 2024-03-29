<?php

namespace App\Enums\Booking;

enum RequestStatusEnum: string
{
  case PENDING   = 'Pending';
  case ACCEPTED  = 'Accepted';
  case REJECTED  = 'Rejected';
  case CANCELLED = 'Cancelled';
  case RESCHEDULED = 'Rescheduled';
}
