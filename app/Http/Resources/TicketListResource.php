<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketListResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id'          => $this->id,
      'ticket_id'   => $this->ticket_id,
      'title'       => $this->title,
      'description' => $this->description,
      'status'      => strtolower($this->status?->value),
      'closed_at'   => $this->closed_at?->format('F j, Y, g:i A'),
      'created_at'  => $this->created_at?->format('F j, Y, g:i A'),
      'reopned_at'  => $this->reopened_at?->format('F j, Y, g:i A'),
    ];
  }
}
