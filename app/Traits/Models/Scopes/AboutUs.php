<?php

namespace App\Traits\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait AboutUs
{
  /**
   * Filter results to include only published records.
   */
  public function scopePublished(Builder $builder, bool $published = true): Builder
  {
    return $builder->wherePublished($published);
  }
}
