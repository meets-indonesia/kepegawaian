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
        Schema::create('diklat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('jumlah_jam', 100);
            $table->string('penyelenggara', 100);
            $table->string('tempat', 100);
            $table->string('angkatan', 20);
            $table->year('tahun');
            $table->integer('nomor');
            $table->date('tanggal_sttp');
            $table->string('sertifikat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diklat');
    }
};
