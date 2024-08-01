<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;

class Reply extends Model
{
  use HasFactory;
  use DynamicUpdateTrait;

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = ["id"];

  /**
   * Get the author that owns the reply.
   */
  public function author(): MorphTo
  {
    return $this->morphTo();
  }
}
