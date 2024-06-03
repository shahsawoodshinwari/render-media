<?php

namespace App\Rules;

use Closure;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\ValidationRule;

class NotPreviousPassword implements ValidationRule
{
  /**
   * Create a new rule instance.
   */
  public function __construct(
    protected Member $member
  ) {}

  /**
   * Run the validation rule.
   *
   * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    if (Hash::check($value, $this->member->password)) {
      $fail(__('validation.not_previous_password', ['attribute' => $attribute]));
    }
  }
}
