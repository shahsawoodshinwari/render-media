<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
