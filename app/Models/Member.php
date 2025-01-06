<?php

namespace App\Models;

use App\Enums\FileTypeEnum;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use App\Notifications\VerifyEmail;
use App\Traits\Models\FirebaseTokenable;
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
use App\Contracts\FirebaseTokenable as FirebaseTokenableContract;

/**
 * Represents a member of the application.
 *
 * The Member class represents a user of the application.
 * It extends the Authenticatable class, which is part of the Laravel authentication
 * system, and implements the MustVerifyEmail interface, which requires the user
 * to verify their email address. The class also implements the HasMedia interface,
 * which allows the user to have media attached to them.
 *
 * The Member class has the following constants:
 *   - AVATAR: The string "Avatar", which represents the name of the media collection
 *     for the user's avatar.
 *
 * The Member class has the following properties:
 *   - $guarded: An array of strings, representing the attributes that are not mass assignable.
 *     It consists of the string "id".
 *
 * The Member class has the following methods:
 *   - casts(): An array of strings, representing the attributes that should be casted.
 *     It consists of the key-value pair "password" => "hashed".
 *   - sendEmailVerificationNotification(): Sends the email verification notification to the user.
 *   - sendPasswordResetNotification($token): Sends a password reset notification to the user.
 *   - registerMediaCollections(): Registers the media collections for the user.
 */
class Member extends Authenticatable implements MustVerifyEmail, HasMedia, FirebaseTokenableContract
{
  use HasFactory;
  use Notifiable;
  use HasApiTokens;
  use HasOneMember;
  use HasManyMember;
  use MethodsMember;
  use AttributesMember;
  use FirebaseTokenable;
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
