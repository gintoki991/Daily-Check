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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('site_id')->after('id'); // site_idカラムを追加
            $table->foreign('site_id')->references('id')->on('sites'); // 外部キー制約を追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['site_id']); // 外部キー制約を削除
            $table->dropColumn('site_id'); // site_idカラムを削除
        });
    }
};
