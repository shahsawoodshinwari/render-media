<?php

use App\Models\Member;
use App\Enums\TicketStatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('tickets', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Member::class);
      $table->string('ticket_id')->index();
      $table->string('title')->nullable();
      $table->text('description')->nullable();
      $table->string('status')->default(TicketStatusEnum::OPEN)->index();
      $table->dateTime('closed_at')->nullable();
      $table->dateTime('reopned_at')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tickets');
  }
};
