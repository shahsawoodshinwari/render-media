<?php

namespace App\Http\Requests\Api;

use App\Rules\NameRule;
use App\Models\Category;
use Illuminate\Validation\Rule;
use App\Enums\Booking\ShootingTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
      'category_id'     => ['required', Rule::exists((new Category())->getTable(), 'id')->whereNull('parent_id')],
      'sub_category_id' => ['required', Rule::exists((new Category())->getTable(), 'id')->whereNotNull('parent_id')],
      'lat'   => ['required', 'numeric'],
      'lng'   => ['required', 'numeric'],
      'date'  => ['required', 'date'],
      'time'  => ['required', 'date_format:H:i'],
      'address' => ['nullable', 'string', 'max:255'],
      'member_first_name' => ['required', new NameRule(), 'string', 'max:255'],
      'member_last_name'  => ['required', new NameRule(), 'string', 'max:255'],
      'member_email'  => ['required', 'string', 'email', 'max:255'],
      'member_phone'  => ['required', 'string', 'phone:AE', 'max:255'],
      'shooting_type' => ['required', Rule::enum(ShootingTypeEnum::class)],
      'additional_notes'  => ['nullable', 'string', 'max:255'],
    ];
  }
}
