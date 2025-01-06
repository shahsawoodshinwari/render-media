<?php

namespace App\Traits\Models\BelongsTo;

use App\Models\Member;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Booking
{
  /**
   * Get the category that owns the Booking
   */
  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  /**
   * Get the sub category that owns the Booking
   */
  public function subCategory(): BelongsTo
  {
    return $this->belongsTo(Category::class, 'sub_category_id');
  }

  /**
   * Get the member that owns the Booking
   */
  public function member(): BelongsTo
  {
    return $this->belongsTo(Member::class);
  }
}
