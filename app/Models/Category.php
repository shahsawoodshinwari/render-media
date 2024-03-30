<?php

namespace App\Models;

use App\Enums\FileTypeEnum;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;
use App\Traits\Models\HasOne\Category as HasOneCategory;
use App\Traits\Models\HasMany\Category as HasManyCategory;
use App\Traits\Models\Methods\Category as MethodsCategory;
use App\Traits\Models\BelongsTo\Category as BelongsToCategory;

class Category extends Model implements HasMedia
{
  use HasSlug;
  use HasFactory;
  use HasOneCategory;
  use HasManyCategory;
  use MethodsCategory;
  use BelongsToCategory;
  use DynamicUpdateTrait;
  use InteractsWithMedia;

  /**
   * The media collection name for the model's cover photo.
   *
   * @var string
   */
  public const COVER = 'Cover';

  protected $perPage = 10;

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = ['id'];

  /**
   * Get the options for generating the slug.
   */
  public function getSlugOptions(): SlugOptions
  {
    return SlugOptions::create()
      ->generateSlugsFrom('name')
      ->saveSlugsTo('slug');
  }

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'slug';
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection(self::COVER)
      ->singleFile()
      ->acceptsMimeTypes(FileTypeEnum::imageTypes());
  }
}
