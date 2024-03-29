<?php

namespace App\Enums;

use App\Traits\EnumFormatTrait;

enum GenderEnum: string
{
  use EnumFormatTrait;

  case MALE = 'male';
  case FEMALE = 'female';
  case OTHER = 'other';
}
