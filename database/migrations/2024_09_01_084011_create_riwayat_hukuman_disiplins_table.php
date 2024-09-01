<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatHukumanDisiplinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_hukuman_disiplins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id'); // Foreign key to the pegawai table
            $table->unsignedBigInteger('hukuman_disiplin_id'); // Foreign key to the hukuman_disiplin table
            $table->date('tanggal_hukuman');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');
            $table->foreign('hukuman_disiplin_id')->references('id')->on('hukuman_disiplin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riwayat_hukuman_disiplins', function (Blueprint $table) {
            $table->dropForeign(['pegawai_id']);
            $table->dropForeign(['hukuman_disiplin_id']);
        });

        Schema::dropIfExists('riwayat_hukuman_disiplins');
    }
}
