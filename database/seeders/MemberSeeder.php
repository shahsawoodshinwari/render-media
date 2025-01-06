<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $members = Member::factory()->count(10)->make();

    $this->command->withProgressBar($members, fn($member) => $member->save());

    $this->command->newLine();
  }
}
