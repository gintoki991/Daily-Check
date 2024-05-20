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
        Schema::create('daily_report_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daily_report_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('site_id');
            $table->boolean('is_scheduled');
            $table->boolean('is_actual');
            $table->timestamps();

            $table->foreign('daily_report_id')->references('id')->on('daily_reports')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');

            $table->unique(['daily_report_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_report_user');
    }
};
