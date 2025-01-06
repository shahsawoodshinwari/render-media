<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\Member;
use App\Rules\NameRule;
use App\Enums\GenderEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    \Log::debug(json_encode($this->all()));
    return [
      'first_name' => ['required', 'string', 'max:255', new NameRule()],
      'last_name'  => ['required', 'string', 'max:255', new NameRule()],
      'email'      => ['required', 'string', 'email', 'max:255', Rule::unique(Member::class, 'email')],
      'phone'      => ['required', 'phone:AE', 'string', 'max:255', Rule::unique(Member::class, 'phone')],
      'gender'     => ['required', Rule::enum(GenderEnum::class)],
      'password'   => ['required', 'string', Password::defaults(), 'confirmed'],
      'privacy'    => ['accepted'],
    ];
  }
}
