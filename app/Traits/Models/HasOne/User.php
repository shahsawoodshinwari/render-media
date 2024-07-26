<?php

namespace App\Traits\Models\HasOne;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait User
{
  /**
   * Get the avatar of the model.
   */
  public function avatar(): HasOne
  {
    return $this->hasOne(Media::class, 'model_id')
      ->whereModelType(static::class)
      ->whereCollectionName(static::AVATAR);
  }
}
