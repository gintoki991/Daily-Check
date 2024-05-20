<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id')->nullable();
            $table->unsignedBigInteger('scheduled_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('time');
            $table->string('comment')->nullable();
            $table->string('person_in_charge');
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('sites');
            $table->foreign('scheduled_id')->references('id')->on('scheduleds');
            $table->foreign('user_id')->references('id')->on('users');
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
