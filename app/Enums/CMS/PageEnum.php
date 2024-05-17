<?php

namespace App\Enums\CMS;

use App\Traits\EnumFormatTrait;

enum PageEnum: string
{
  use EnumFormatTrait;

  case TERMS_AND_CONDITIONS = 'terms-and-conditions';
  case ABOUT_US = 'about-us';
}
