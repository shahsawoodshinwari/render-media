<?php

namespace App\Traits\Models\Attributes;

use App\Enums\Freelancer\StatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait Freelancer
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

  public function statusHtml(): Attribute
  {
    return new Attribute(
      get: function () {
        switch ($this->status) {
          case StatusEnum::ACTIVE:
            return '<span class="badge badge-success">' . $this->status->value . '</span>';
          case StatusEnum::INACTIVE:
            return '<span class="badge badge-danger">' . $this->status->value . '</span>';
          case StatusEnum::SUSPENDED:
            return '<span class="badge badge-warning">' . $this->status->value . '</span>';
          case StatusEnum::PENDING:
            return '<span class="badge badge-secondary">' . $this->status->value . '</span>';
          default:
            return '<span class="badge badge-secondary">' . __('Unknown') . '</span>';
        }
      },
    );
  }
}
