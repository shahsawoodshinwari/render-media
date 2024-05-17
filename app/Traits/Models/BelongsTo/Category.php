<?php

namespace App\Traits\Models\BelongsTo;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Category
{
  /**
   * Get the parent of the sub category.
   */
  public function parent(): BelongsTo
  {
    return $this->belongsTo(static::class, 'parent_id');
  }
}
