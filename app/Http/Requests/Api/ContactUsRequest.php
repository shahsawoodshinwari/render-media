<?php

namespace App\Http\Requests\Api;

use App\Rules\NameRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
      'email'      => ['required', 'string', 'email', 'max:255'],
      'phone'      => ['required', 'string', 'phone:AE', 'max:255'],
      'reason'     => ['required', 'string'],
    ];
  }
}
