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
        Schema::create('daily_report_user_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scheduled_user_id');
            $table->unsignedBigInteger('daily_report_id');
            $table->boolean('is_actual')->default(false);
            $table->timestamps();

            $table->foreign('scheduled_user_id')->references('id')->on('scheduled_user')->onDelete('cascade');
            $table->foreign('daily_report_id')->references('id')->on('daily_reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_report_user_roles');
    }
};
