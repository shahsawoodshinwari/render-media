<?php

namespace Database\Factories\CMS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\AboutUs>
 */
class AboutUsFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'contents' => fake()->randomHtml(),
      'published' => fake()->boolean(),
    ];
  }

  /**
   * Set the published state to true.
   */
  public function published(): static
  {
    return $this->state(function (array $attributes) {
      return [
        'published' => true,
      ];
    });
  }

  /**
   * Set the published state to false.
   */
  public function unpublished(): static
  {
    return $this->state(function (array $attributes) {
      return [
        'published' => false,
      ];
    });
  }
}
