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
        Schema::create('grade', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('value', 100);
            $table->foreignId('jabatan_fungsional_id')->constrained('jabatan_fungsional')->onDelete('cascade');
            $table->foreignId('jabatan_struktural_id')->constrained('jabatan_struktural')->onDelete('cascade');
            $table->foreignId('pendidikan_id')->constrained('pendidikan')->onDelete('cascade')->nullable();
            $table->foreignId('kelompok_pegawai_id')->constrained('kelompok_pegawai')->onDelete('cascade')->nullable();
            $table->foreignId('unit_kerja_id')->constrained('unit_kerja')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade');
    }
};
