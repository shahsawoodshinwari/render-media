<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface FirebaseTokenable
{
  public function firebaseTokens(): MorphMany;
}
