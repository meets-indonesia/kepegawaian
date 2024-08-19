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
        Schema::create('riwayat_jabatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->foreignId('unit_kerja_id')->constrained('unit_kerja')->onDelete('cascade');
            $table->foreignId('eselon_id')->constrained('eselon')->onDelete('cascade');
            $table->foreignId('jabatan_struktural_id')->constrained('jabatan_struktural')->onDelete('cascade');
            $table->foreignId('jabatan_fungsional_id')->constrained('jabatan_fungsional')->onDelete('cascade');
            $table->string('satuan_kerja', 50);
            $table->enum('jenis', ['Struktural', 'Fungsional Tertentu', 'Rangkat', 'Fungsional Umum']);
            $table->date('tmt_js');
            $table->date('akhir_eselon');
            $table->date('tmt_jf');
            $table->string('nomor_sk', 25);
            $table->date('tanggal_sk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_jabatan');
    }
};
