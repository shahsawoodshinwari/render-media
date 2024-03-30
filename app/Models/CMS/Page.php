<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Scopes\Page as ScopesPage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;

class Page extends Model
{
  use HasFactory;
  use ScopesPage;
  use DynamicUpdateTrait;
}
