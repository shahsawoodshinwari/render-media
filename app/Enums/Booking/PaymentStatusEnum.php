<?php

namespace App\Enums\Booking;

use App\Traits\EnumFormatTrait;

enum PaymentStatusEnum: string
{
  use EnumFormatTrait;

  case PAID    = 'Paid';
  case UNPAID  = 'Unpaid';
  case PARTIAL = 'Partial';
}
