<?php

namespace App\Http\Requests\Api;

use App\Models\Member;
use App\Rules\NameRule;
use App\Enums\GenderEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
      'first_name' => ['required', 'string', new NameRule(), 'max:255'],
      'last_name'  => ['required', 'string', new NameRule(), 'max:255'],
      'email'      => ['required', 'string', 'email', 'max:255', Rule::unique(Member::class, 'email')->ignore($this->user()->id)],
      'phone'      => ['required', 'string', 'phone:AE', 'max:255', Rule::unique(Member::class, 'phone')->ignore($this->user()->id)],
      'gender'     => ['required', Rule::enum(GenderEnum::class)],
      'dob'        => ['required', 'date'],
    ];
  }
}
