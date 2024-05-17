<?php

namespace App\Enums;

use App\Traits\EnumFormatTrait;

enum GenderEnum: string
{
  use EnumFormatTrait;

  case MALE   = 'Male';
  case FEMALE = 'Female';
  case OTHER  = 'Other';
}
