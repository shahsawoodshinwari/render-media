<?php

namespace App\Models;

use App\Enums\TicketStatusEnum;
use App\Observers\TicketObserver;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Ticket as TicketScopes;
use App\Models\HasMany\Ticket as TicketHasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Traits\Models\BelongsTo\Ticket as TicketBelongsTo;

#[ObservedBy([TicketObserver::class])]
class Ticket extends Model
{
  use HasFactory;
  use TicketScopes;
  use TicketHasMany;
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
      'status'     => TicketStatusEnum::class,
      'closed_at'  => 'datetime',
      'reopned_at' => 'datetime',
    ];
  }

  /**
   * Get the next ticket id.
   */
  public static function generateTicketId(): int
  {
    $maxTicketId = (int) self::max('ticket_id') ?? 0;
    $newId = max($maxTicketId + 1, 1000);

    while (self::where('ticket_id', $newId)->exists()) {
      $newId++;
    }

    return $newId;
  }
}
