<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Enums\Booking\PaymentStatusEnum;
use App\Enums\Booking\RequestStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
      'payment_status' => ['nullable', Rule::in(PaymentStatusEnum::values())],
      'request_status' => ['nullable', Rule::in(RequestStatusEnum::values())],
    ];
  }
}
