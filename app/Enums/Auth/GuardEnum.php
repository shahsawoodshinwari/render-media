<?php

namespace App\Enums\Auth;

use App\Traits\EnumFormatTrait;

enum GuardEnum: string
{
  use EnumFormatTrait;

  case WEB     = 'web';
  case MEMBERS = 'members';
}
