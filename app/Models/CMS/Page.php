<?php

namespace App\Models\CMS;

use App\Enums\CMS\PageEnum;
use App\Observers\CMS\PageObserver;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Scopes\Page as ScopesPage;
use App\Traits\Models\Methods\Page as MethodsPage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;
use App\Traits\Models\Attributes\Page as AttributesPage;

#[ObservedBy([PageObserver::class])]
class Page extends Model
{
  use HasFactory;
  use ScopesPage;
  use MethodsPage;
  use AttributesPage;
  use DynamicUpdateTrait;

  /**
   * Get the attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected function casts(): array
  {
    return [
      'page' => PageEnum::class,
    ];
  }
}
