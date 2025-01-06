<?php

namespace App\Enums\Booking;

use App\Traits\BinaryEnumTrait;
use App\Traits\EnumFormatTrait;

enum PaymentStatusEnum: string
{
  use BinaryEnumTrait;
  use EnumFormatTrait;

  case PAID    = 'Paid';
  case UNPAID  = 'Unpaid';
  case PARTIAL = 'Partial';
}
