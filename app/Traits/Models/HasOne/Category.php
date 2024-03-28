<?php

namespace App\Traits\Models\HasOne;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait Category
{
  /**
   * Get the cover media of the category.
   */
  public function cover(): HasOne
  {
    return $this->hasOne(Media::class, 'model_id')
      ->whereModelType(static::class)
      ->whereCollectionName(static::COVER);
  }
}
