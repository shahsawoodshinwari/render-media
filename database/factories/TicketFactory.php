<?php

namespace Database\Factories;

use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $status = fake()->randomElement(TicketStatusEnum::values());
    return [
      'ticket_id'   => fake()->numberBetween(10000, 99999),
      'title'       => fake()->sentence(),
      'description' => fake()->paragraph(),
      'status'      => $status,
    ];
  }
}
