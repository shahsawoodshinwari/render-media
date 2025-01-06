<?php

namespace Database\Seeders\CMS;

use App\Models\CMS\FAQ;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faqs = FAQ::factory()->count(15)->make();

    $this->command->withProgressBar($faqs, fn($faq) => $faq->save());

    $this->command->newLine();
  }
}
