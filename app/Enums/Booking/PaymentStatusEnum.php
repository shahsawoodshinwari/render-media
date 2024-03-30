<?php

namespace App\Enums\Booking;

use App\Traits\EnumFormatTrait;

enum PaymentStatusEnum: string
{
  use EnumFormatTrait;

  case PENDING = 'Pending';
  case SUCCESS = 'Success';
  case FAILED = 'Failed';
}
