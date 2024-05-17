<?php

namespace App\Traits\Models\HasMany;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait Category
{
  /**
   * Get all of the sub categories for the category.
   */
  public function children(): HasMany
  {
    return $this->hasMany(static::class, 'parent_id');
  }
}
