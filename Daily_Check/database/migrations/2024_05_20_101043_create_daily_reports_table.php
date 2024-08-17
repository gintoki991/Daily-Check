<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('daily_reports', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('site_id');
      $table->unsignedBigInteger('scheduled_id')->nullable();
      $table->time('start_time');
      $table->time('end_time');
      $table->unsignedBigInteger('person_in_charge')->nullable();
      $table->string('comment')->nullable();
      $table->timestamps();

      $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
      $table->foreign('scheduled_id')->references('id')->on('scheduleds')->onDelete('set null');
      $table->foreign('person_in_charge')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('daily_reports');
  }
};
