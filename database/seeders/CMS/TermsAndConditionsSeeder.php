<?php

namespace Database\Seeders\CMS;

use Illuminate\Database\Seeder;
use App\Models\CMS\TermsAndConditions;

class TermsAndConditionsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $termsAndConditions = TermsAndConditions::factory()->count(10)->make();

    $this->command->withProgressBar($termsAndConditions, fn($termsAndCondition) => $termsAndCondition->save());

    $this->command->newLine();
  }
}
