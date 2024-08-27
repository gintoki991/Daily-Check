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
        Schema::create('scheduled_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scheduled_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('site_id');
            $table->timestamps();

            $table->foreign('scheduled_id')->references('id')->on('scheduleds')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');

            $table->unique(['scheduled_id', 'user_id', 'site_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_user');
    }
};
