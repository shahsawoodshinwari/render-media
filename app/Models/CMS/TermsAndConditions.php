<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;

class TermsAndConditions extends Model
{
  use HasFactory;
  use DynamicUpdateTrait;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = "terms_and_conditions";

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = ["id"];
}
