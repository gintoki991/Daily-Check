<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scheduled_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('site_id');
            $table->timestamps();

            $table->foreign('scheduled_id')->references('id')->on('scheduleds')->onDelete('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actuals');
    }
};
