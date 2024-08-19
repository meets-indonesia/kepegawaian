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
        Schema::create('istri_suami', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->foreignId('pendidikan_id')->constrained('pendidikan')->onDelete('cascade');
            $table->string('nama', 100);
            $table->date('tanggal_lahir');
            $table->date('tanggal_nikah');
            $table->string('pekerjaan', 150);
            $table->string('tempat_tinggal', 150);
            $table->enum('status', ['Istri', 'Suami']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('istri_suami');
    }
};
