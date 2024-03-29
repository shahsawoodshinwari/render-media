<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CMS\FAQSeeder;
use Database\Seeders\CMS\AboutUsSeeder;
use Database\Seeders\CMS\ContactUsSeeder;
use Database\Seeders\CMS\TermsAndConditionsSeeder;

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
      AboutUsSeeder::class,
      ContactUsSeeder::class,
      FAQSeeder::class,
      TermsAndConditionsSeeder::class,
    ]);
  }
}
