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
    $categories = $this->categories();
    $children   = $this->children();

    $this->command->withProgressBar($categories, function ($category) use ($children) {
      $category = Category::factory()->create([
        'name' => $category,
      ]);

      $category->uploadCover();

      $category->children()->createMany($children[$category->slug]);
    });

    $this->command->newLine();
  }

  private function categories(): array
  {
    return [
      'Videography',
      'Photography & Edit',
      'Video Shoot Edit',
      'Script Writer / Story Board',
      'Content Creator',
      'Editing',
      'DOP / Director',
    ];
  }

  private function children(): array
  {
    return [
      'videography' => [
        ['name' => 'Event Videography'],
        ['name' => 'Commercial Videography'],
        ['name' => 'Documentary Videography'],
      ],
      'photography-edit' => [
        ['name' => 'Portrait Photography'],
        ['name' => 'Landscape Photography'],
        ['name' => 'Photo Editing Services'],
      ],
      'video-shoot-edit' => [
        ['name' => 'Music Video Production'],
        ['name' => 'Corporate Video Production'],
        ['name' => 'Short Film Production'],
      ],
      'script-writer-story-board' => [
        ['name' => 'Screenplay Writing'],
        ['name' => 'Dialogue Writing'],
        ['name' => 'Storyboarding'],
      ],
      'content-creator' => [
        ['name' => 'Social Media Content Creation'],
        ['name' => 'Blog Content Creation'],
        ['name' => 'Marketing Content Creation'],
      ],
      'editing' => [
        ['name' => 'Film Editing'],
        ['name' => 'Photo Editing'],
        ['name' => 'Audio Editing'],
      ],
      'dop-director' => [
        ['name' => 'Director of Photography (DOP) Services'],
        ['name' => 'Film Direction'],
        ['name' => 'Video Production Direction'],
      ],
    ];
  }
}
