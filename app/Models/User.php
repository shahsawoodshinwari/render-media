<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\Models\HasOne\User as UserHasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;

class User extends Authenticatable implements HasMedia
{
  use HasFactory;
  use Notifiable;
  use UserHasOne;
  use DynamicUpdateTrait;
  use InteractsWithMedia;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The collection name for the user's avatar.
   *
   * @var string
   */
  public const AVATAR = 'Avatar';

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection(static::AVATAR)->singleFile();
  }
}
