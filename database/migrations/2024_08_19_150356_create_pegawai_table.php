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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 25)->unique();
            $table->string('name', 150);
            $table->string('email', 100)->nullable();
            $table->foreignId('golongan_id')->constrained('golongan')->onDelete('cascade')->nullable();
            $table->foreignId('kelompok_pegawai_id')->constrained('kelompok_pegawai')->onDelete('cascade')->nullable();
            $table->foreignId('jenis_pegawai_id')->constrained('jenis_pegawai')->onDelete('cascade')->nullable();
            $table->foreignId('unit_kerja_id')->constrained('unit_kerja')->onDelete('cascade')->nullable();
            $table->foreignId('jurusan_id')->constrained('jurusan')->onDelete('cascade')->nullable();
            $table->foreignId('prodi_id')->constrained('prodi')->onDelete('cascade')->nullable();
            $table->foreignId('grade_id')->constrained('grade')->onDelete('cascade')->nullable();
            $table->date('tamat_cpns')->nullable();
            $table->date('tamat_pns')->nullable();
            $table->foreignId('pendidikan_id')->constrained('pendidikan')->onDelete('cascade')->nullable();
            $table->foreignId('jabatan_fungsional_id')->constrained('jabatan_fungsional')->onDelete('cascade')->nullable();
            $table->foreignId('jabatan_struktural_id')->constrained('jabatan_struktural')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
