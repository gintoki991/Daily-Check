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
        Schema::create('scheduleds', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->unsignedBigInteger('site_id');
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduleds');
    }
};
