<?php

namespace App\Enums\Booking;

enum PaymentStatusEnum: string
{
  case PENDING = 'Pending';
  case SUCCESS = 'Success';
  case FAILED = 'Failed';
}
