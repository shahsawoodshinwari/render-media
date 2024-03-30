<?php

namespace Database\Factories\CMS;

use App\Enums\CMS\PageEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PageFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'name'     => fake()->randomElement(PageEnum::values()),
      'contents' => fake()->randomHtml(),
      'published'  => fake()->boolean(),
    ];
  }
}
