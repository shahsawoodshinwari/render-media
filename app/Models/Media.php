<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Media extends SpatieMedia
{
  use HasFactory;
  use DynamicUpdateTrait;
}
