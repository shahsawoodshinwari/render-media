<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
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
      'last_name'  => fake()->lastName(),
      'email'      => fake()->unique()->safeEmail(),
      'phone'      => fake()->unique()->phoneNumber(),
      'gender'     => fake()->randomElement(GenderEnum::values()),
      'password'   => 'password',
    ];
  }
}