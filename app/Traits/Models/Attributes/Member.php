<?php

namespace App\Traits\Models\Attributes;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait Member
{
  /**
   * Interact with the model's name.
   */
  public function name(): Attribute
  {
    return new Attribute(
      get: fn($value, $attributes) => $attributes['first_name'] . ' ' . $attributes['last_name'],
    );
  }
}
