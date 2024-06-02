<?php

namespace App\Models;

use App\Enums\Freelancer\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;
use App\Traits\Models\Attributes\Freelancer as FreelancerAttributes;

class Freelancer extends Model
{
  use HasFactory;
  use SoftDeletes;
  use DynamicUpdateTrait;
  use FreelancerAttributes;

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = ["id"];

  /**
   * Get the attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected function casts(): array
  {
    return [
      'status' => StatusEnum::class,
    ];
  }
}
