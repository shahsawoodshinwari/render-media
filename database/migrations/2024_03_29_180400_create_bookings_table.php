<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('bookings', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger('member_id')->nullable();
      $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');

      $table->unsignedBigInteger('category_id')->nullable();
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

      $table->unsignedBigInteger('sub_category_id')->nullable();
      $table->foreign('sub_category_id')->references('id')->on('categories')->onDelete('set null');

      $table->unsignedBigInteger('booking_id')->unique();
      $table->string('request_status');
      $table->string('payment_status');

      $table->float('lat')->nullable();
      $table->float('lng')->nullable();
      $table->string('address')->nullable();
      $table->date('date')->nullable();
      $table->time('time')->nullable();

      $table->string('member_first_name')->nullable();
      $table->string('member_last_name')->nullable();
      $table->string('member_email')->nullable();
      $table->string('member_phone')->nullable();
      $table->string('shooting_type')->nullable();
      $table->string('additional_details')->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('bookings');
  }
};
