<?php

namespace Database\Factories;

use App\Enums\Freelancer\StatusEnum;
use App\Traits\Factories\FakePhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Freelancer>
 */
class FreelancerFactory extends Factory
{
  use FakePhoneNumber;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'first_name'  => fake()->firstName(),
      'last_name'   => fake()->lastName(),
      'speciality'  => fake()->jobTitle(),
      'experience'  => fake()->numberBetween(1, 5),
      'phone'       => $this->phoneNumber(),
      'portfolio'   => fake()->url(),
      'status'      => (fake()->randomElement(StatusEnum::cases()))->value,
    ];
  }
}
