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
        Schema::create('scheduled_user_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scheduled_user_id');
            $table->boolean('is_scheduled')->default(false);
            $table->boolean('is_actual')->default(false);
            $table->timestamps();
            
            $table->foreign('scheduled_user_id')->references('id')->on('scheduled_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_user_roles');
    }
};
