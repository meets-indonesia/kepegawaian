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
        Schema::create('riwayat_mutasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->string('no_sk', 100)->nullable();
            $table->enum('jenis', ['Masuk', 'Keluar', 'Pindah Antar Instansi', 'Pensiun', 'Wafat', 'Kenaikan Pangkat'])->nullable();
            $table->foreignId('fakultas_id')->constrained('fakultas')->nullable()->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusan')->nullable()->onDelete('cascade');
            $table->foreignId('prodi_id')->constrained('prodi')->nullable()->onDelete('cascade');
            $table->date('tanggal_sk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_mutasi');
    }
};
