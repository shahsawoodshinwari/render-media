<?php

namespace App\Models;

use App\Enums\FileTypeEnum;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use App\Notifications\VerifyEmail;
use App\Traits\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use App\Traits\Models\HasOne\Member as HasOneMember;
use App\Traits\Models\HasMany\Member as HasManyMember;
use App\Traits\Models\Methods\Member as MethodsMember;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Shaka\DynamicUpdateTrait\Traits\DynamicUpdateTrait;
use App\Traits\Models\Attributes\Member as AttributesMember;

class Member extends Authenticatable implements MustVerifyEmail, HasMedia
{
  use HasFactory;
  use Notifiable;
  use HasApiTokens;
  use HasOneMember;
  use HasManyMember;
  use MethodsMember;
  use AttributesMember;
  use DynamicUpdateTrait;
  use InteractsWithMedia;

  /**
   * The avatar's collection name.
   *
   * @var string
   */
  public const AVATAR = "Avatar";

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

  /**
   * Send a password reset notification to the user.
   *
   * @param  string  $token
   */
  public function sendPasswordResetNotification($token): void
  {
    $this->notify(new ResetPasswordNotification($token));
  }

  /**
   * Register the media collections.
   */
  public function registerMediaCollections(): void
  {
    $this->addMediaCollection(self::AVATAR)
      ->acceptsMimeTypes(FileTypeEnum::imageTypes())
      ->singleFile();
  }
}
