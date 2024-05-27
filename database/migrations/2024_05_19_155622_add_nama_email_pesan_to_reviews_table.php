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
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('nama')->after('user_id'); // Menambahkan kolom nama setelah user_id
            $table->string('email')->after('nama'); // Menambahkan kolom email setelah nama
            $table->text('pesan')->after('email'); // Menambahkan kolom pesan setelah email
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            //
        });
    }
};
