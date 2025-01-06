<?php

namespace Database\Factories\CMS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\ContactUs>
 */
class ContactUsFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'first_name' => fake()->firstName(),
      'last_name' => fake()->lastName(),
      'email' => fake()->safeEmail(),
      'phone' => fake()->phoneNumber(),
      'reason' => fake()->sentence(),
    ];
  }
}
