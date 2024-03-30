<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id'    => $this->id,
      'category' => [
        'id'    => $this->category_id,
        'title' => $this->category->name,
      ],
      'sub_category' => [
        'id'    => $this->sub_category_id,
        'title' => $this->subCategory->name,
      ],
      'address' => $this->address,
      'date'    => $this->date->format('d M, Y'),
      'time'    => $this->time->format('h:i a'),
      'booking_id' => $this->booking_id,
      'request_status' => $this->request_status,
      'payment_status' => $this->payment_status,
    ];
  }
}
