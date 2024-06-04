<?php

namespace App\Http\Requests;

use App\Rules\NameRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFreelancerRequest extends FormRequest
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
      'phone'      => ['required', 'phone:AE', 'string', 'max:255'],
      'speciality' => ['required', 'string', 'max:255'],
      'experience' => ['required', 'min:0.1', 'numeric', 'max:255'],
      'portfolio'  => ['nullable', 'url', 'string', 'max:255'],
    ];
  }
}
