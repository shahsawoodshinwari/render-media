<?php

namespace Database\Seeders\CMS;

use App\Models\CMS\Page;
use App\Enums\CMS\PageEnum;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $pages = collect();

    $pages->push(
      Page::factory()->make(['name' => PageEnum::TERMS_AND_CONDITIONS]),
      Page::factory()->make(['name' => PageEnum::ABOUT_US]),
    );

    $this->command->withProgressBar($pages, fn($page) => $page->save());

    $this->command->newLine();
  }
}
