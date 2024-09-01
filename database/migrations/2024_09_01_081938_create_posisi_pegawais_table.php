<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosisiPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posisi_pegawais', function (Blueprint $table) {
            $table->unsignedBigInteger('pegawai_id')->primary();
            $table->unsignedBigInteger('posisi_id');
            $table->unsignedBigInteger('unit_kerja_id');
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->unsignedBigInteger('atasan_id')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');
            $table->foreign('posisi_id')->references('id')->on('posisis')->onDelete('cascade');
            $table->foreign('unit_kerja_id')->references('id')->on('unit_kerja')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('cascade');
            $table->foreign('atasan_id')->references('pegawai_id')->on('posisi_pegawais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posisi_pegawais');
    }
}

