<?php

namespace App\Enums\Freelancer;

enum StatusEnum: string
{
  case PENDING   = 'Pending';
  case INACTIVE  = 'Inactive';
  case SUSPENDED = 'Suspended';
  case ACTIVE    = 'Active';
}
