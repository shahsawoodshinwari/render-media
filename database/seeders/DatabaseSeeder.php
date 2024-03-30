<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CMS\FAQSeeder;
use Database\Seeders\CMS\PageSeeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      SuperAdminSeeder::class,
      MemberSeeder::class,
      CategorySeeder::class,
      PageSeeder::class,
      FAQSeeder::class,
    ]);
  }
}
