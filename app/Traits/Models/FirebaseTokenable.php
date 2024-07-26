<?php

namespace App\Traits\Models;

use App\Models\FirebaseToken;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait FirebaseTokenable
{
  public function firebaseTokens(): MorphMany
  {
    return $this->morphMany(FirebaseToken::class, 'tokenable');
  }

}
