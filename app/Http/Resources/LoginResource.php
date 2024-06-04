<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id'     => $this->id,
      'first_name' => $this->first_name,
      'last_name'  => $this->last_name,
      'name'   => $this->name,
      'email'  => $this->email,
      'phone'  => $this->phone,
      'gender' => $this->gender,
      'dob'    => $this->dob,
      'verified' => $this->hasVerifiedEmail(),
      'token'  => $this->when($request->withToken ?? true, $this->createPersonalAccessToken()->plainTextToken),
      'image'  => $this->avatar?->getUrl() ?? asset('assets/members/avatar.png'),
    ];
  }
}
