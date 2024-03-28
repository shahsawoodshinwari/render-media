<?php

namespace Database\Seeders\CMS;

use App\Models\CMS\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    AboutUs::factory()->create();
  }
}
