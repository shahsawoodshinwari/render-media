<?php

namespace App\Models;

use App\Enums\Booking\ShootingTypeEnum;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Booking\PaymentStatusEnum;
use App\Enums\Booking\RequestStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;
use App\Traits\Models\Methods\Booking as MethodsBooking;
use App\Traits\Models\BelongsTo\Booking as BelongsToBooking;

class Booking extends Model
{
  use HasFactory;
  use MethodsBooking;
  use BelongsToBooking;
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
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'request_status' => RequestStatusEnum::class,
      'payment_status' => PaymentStatusEnum::class,
      'shooting_type'  => ShootingTypeEnum::class,
      'date'           => 'datetime',
      'time'           => 'datetime',
    ];
  }

  /**
   * The "booted" method of the model.
   */
  protected static function booted(): void
  {
    static::creating(function (self $booking) {
      $booking->booking_id = now()->getTimestamp();
    });
  }
}
