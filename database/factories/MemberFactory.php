<?php

namespace Database\Factories;

use App\Models\Member;
use App\Enums\GenderEnum;
use App\Traits\Factories\FakePhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
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
      'first_name' => fake()->firstName(),
      'last_name'  => fake()->lastName(),
      'email'      => fake()->unique()->safeEmail(),
      'phone'      => fake()->unique()->phoneNumber(),
      'gender'     => fake()->randomElement(GenderEnum::values()),
      'password'   => 'password',
    ];
  }

  /**
   * Configure the model factory.
   */
  public function configure(): static
  {
    return $this->afterMaking(function (Member $model) {
      // ...
    })->afterCreating(function (Member $model) {
      $model->uploadRandomAvatar();
    });
  }
}
