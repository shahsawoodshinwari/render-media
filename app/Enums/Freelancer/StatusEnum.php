<?php

namespace App\Enums\Freelancer;

use App\Traits\EnumFormatTrait;

enum StatusEnum: string
{
  use EnumFormatTrait;
  
  case PENDING   = 'Pending';
  case INACTIVE  = 'Inactive';
  case SUSPENDED = 'Suspended';
  case ACTIVE    = 'Active';
}
