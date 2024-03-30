<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Scopes\AboutUs as ScopesAboutUs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;

class AboutUs extends Model
{
  use HasFactory;
  use ScopesAboutUs;
  use DynamicUpdateTrait;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = "about_us";

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = ["id"];

  /**
   * The "booted" method of the model.
   */
  protected static function booted(): void
  {
    static::creating(function (self $model) {
      if ($model->published) {
        self::published()->limit(1)->inRandomOrder()->update(['published' => false]);
      }
    });

    static::updated(function (self $model) {
      if ($model->published) {
        self::published()->where('id', '!=', $model->id)->update(['published' => false]);
      }
    });

    static::deleting(function (self $model) {
      if ($model->published) {
        self::published(false)->limit(1)->inRandomOrder()->update(['published' => true]);
      }
    });
  }
}
