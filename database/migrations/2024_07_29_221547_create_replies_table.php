<?php

use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('replies', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Ticket::class);
      $table->foreignIdFor(Reply::class)->nullable();
      $table->morphs('author');
      $table->text('content');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('replies');
  }
};
