<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      'Videography',
      'Photography & Edit',
      'Video Shoot Edit',
      'Script Writer / Story Board',
      'Content Creator',
      'Editing',
      'DOP / Director',
    ];

    $this->command->withProgressBar($categories, fn(string $category) => Category::create([
      'name' => $category,
    ]));

    $this->command->newLine();
  }
}
