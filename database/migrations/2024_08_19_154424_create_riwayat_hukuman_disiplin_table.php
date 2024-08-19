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
        Schema::create('riwayat_hukuman_disiplin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->foreignId('hukuman_disiplin_id')->constrained('hukuman_disiplin')->onDelete('cascade');
            $table->string('nomor_sk', 100);
            $table->date('tanggal_sk');
            $table->date('tmt_hd');
            $table->string('masa_tahun', 25);
            $table->string('masa_bulan', 25);
            $table->date('akhir_hukuman');
            $table->string('golongan_ruang', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_hukuman_disiplin');
    }
};
