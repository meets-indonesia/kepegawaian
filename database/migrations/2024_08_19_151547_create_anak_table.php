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
        Schema::create('anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->foreignId('pendidikan_id')->constrained('pendidikan')->onDelete('cascade');
            $table->string('name', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('pekerjaan', 150);
            $table->string('tempat_tinggal', 150);
            $table->date('tanggal_lahir');
            $table->enum('status', ['Anak Kandung', 'Anak Angkat']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
