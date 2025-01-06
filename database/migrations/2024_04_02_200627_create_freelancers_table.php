<?php

use App\Enums\Freelancer\StatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('freelancers', function (Blueprint $table) {
      $table->id();

      $table->firstName();
      $table->lastName();
      $table->string('speciality');
      $table->string('experience');
      $table->phone();
      $table->string('portfolio')->nullable();
      $table->string('status')->default(StatusEnum::PENDING);

      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('freelancers');
  }
};
