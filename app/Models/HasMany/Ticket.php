<?php

namespace App\Models\HasMany;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Ticket
{
  public function replies(): HasMany
  {
    return $this->hasMany(Reply::class);
  }
}
