<?php

namespace App\Models;

use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Ticket as TicketScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;
use App\Traits\Models\BelongsTo\Ticket as TicketBelongsTo;

class Ticket extends Model
{
  use HasFactory;
  use TicketScopes;
  use TicketBelongsTo;
  use DynamicUpdateTrait;

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
      'status' => TicketStatusEnum::class,
      'closed_at' => 'datetime',
    ];
  }
}
