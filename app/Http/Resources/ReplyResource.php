<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id'            => $this->id,
      'message'       => $this->content,
      'sender'        => $this->author?->is(auth()->user()) ? 'You' : $this->author?->name,
      'actual_sender' => $this->author?->name,
      'date'          => $this->created_at?->format('F j, Y'),
      'time'          => $this->created_at?->format('g:i A'),
    ];
  }
}
