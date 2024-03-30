<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $models = ContactUs::factory()->count(10)->make();

    $this->command->withProgressBar($models, fn($model) => $model->save());

    $this->command->newLine();
  }
}
