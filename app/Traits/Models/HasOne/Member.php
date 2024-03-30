<?php

namespace App\Traits\Models\HasOne;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait Member
{
  /**
   * Get the avatar of the member.
   */
  public function avatar(): HasOne
  {
    return $this->hasOne(Media::class, 'model_id')
      ->whereModelType(static::class)
      ->whereCollectionName(static::AVATAR);
  }
}
