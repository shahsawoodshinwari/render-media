<?php

namespace App\Enums\Booking;

use App\Traits\EnumFormatTrait;

enum ShootingTypeEnum: string
{
  use EnumFormatTrait;

  case INDIVIDUAL = 'Individual';
  case GROUP      = 'Group';
}
