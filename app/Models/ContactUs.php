<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;

class ContactUs extends Model
{
  use HasFactory;
  use DynamicUpdateTrait;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = "contact_us";

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = ["id"];
}
