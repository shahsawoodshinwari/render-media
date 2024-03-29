<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Notifications\VerifyEmail;
use App\Traits\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Models\HasMany\Member as HasManyMember;
use App\Traits\Models\Methods\Member as MethodsMember;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;

class Member extends Authenticatable implements MustVerifyEmail
{
  use HasFactory;
  use Notifiable;
  use HasApiTokens;
  use HasManyMember;
  use MethodsMember;
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
      'password' => 'hashed',
    ];
  }

  /**
   * Send the email verification notification.
   */
  public function sendEmailVerificationNotification(): void
  {
    $this->notify(new VerifyEmail());
  }
}
