<?php

namespace App\Traits\Models\Attributes;

use App\Enums\CMS\PageEnum;
use InvalidArgumentException;

trait Page
{
  /**
   * Set the value of a given attribute.
   */
  public function setAttribute($key, $value)
  {
    if ($key === 'name' && !in_array($value, PageEnum::values())) {
      throw new InvalidArgumentException("Invalid value `" . $value ."` for name. Valid values are: " . implode(', ', PageEnum::values()));
    }

    return parent::setAttribute($key, $value);
  }
}
