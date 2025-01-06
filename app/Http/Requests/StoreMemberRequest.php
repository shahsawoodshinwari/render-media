<?php

namespace App\Http\Requests;

use App\Models\Member;
use App\Rules\NameRule;
use App\Enums\GenderEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
    return [
      'first_name' => ['required', 'string', 'max:255', new NameRule()],
      'last_name'  => ['required', 'string', 'max:255', new NameRule()],
      'email'      => ['required', 'email', 'max:255', Rule::unique((new Member())->getTable(), 'email')],
      'phone'      => ['required', 'string', 'phone:AE', 'max:255', Rule::unique((new Member())->getTable(), 'phone')],
      'gender'     => ['required', Rule::enum(GenderEnum::class)],
      'dob'        => ['nullable', 'date', 'before:today'],
      'password'   => ['required', 'string', Password::defaults(), 'confirmed'],
    ];
  }
}
