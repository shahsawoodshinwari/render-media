<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Models\HasOne\FirebaseToken as FirebaseTokenHasOne;
use App\Traits\Models\Scopes\FirebaseToken as FirebaseTokenScopes;
use App\Traits\Models\HasMany\FirebaseToken as FirebaseTokenHasMany;
use App\Traits\Models\Methods\FirebaseToken as FirebaseTokenMethods;
use App\Traits\Models\MorphTo\FirebaseToken as FirebaseTokenMorphTo;
use App\Traits\Models\BelongsTo\FirebaseToken as FirebaseTokenBelongsTo;
use App\Traits\Models\Attributes\FirebaseToken as FirebaseTokenAttributes;
use App\Traits\Models\HasManyThrough\FirebaseToken as FirebaseTokenHasManyThrough;

class FirebaseToken extends Model
{
  use HasFactory;
  use SoftDeletes;
  use FirebaseTokenScopes;
  use FirebaseTokenHasOne;
  use FirebaseTokenMethods;
  use FirebaseTokenHasMany;
  use FirebaseTokenMorphTo;
  use FirebaseTokenBelongsTo;
  use FirebaseTokenAttributes;
  use FirebaseTokenHasManyThrough;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  // protected $table = '';

  /**
   * The model's default values for attributes.
   *
   * @var array
   */
  protected $attributes = [];

  /**
  * The attributes that aren't mass assignable.
  *
  * @var array
  */
  protected $guarded = ['id'];
}
