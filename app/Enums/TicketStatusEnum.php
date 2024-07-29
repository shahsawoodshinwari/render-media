<?php

namespace App\Enums;

use App\Traits\EnumFormatTrait;

enum TicketStatusEnum: string
{
  use EnumFormatTrait;

  case OPEN = 'Open';
  case CLOSED = 'Closed';
}
