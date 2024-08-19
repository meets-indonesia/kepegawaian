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
        Schema::create('struktur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_struktural_id')->constrained('jabatan_struktural')->onDelete('cascade');
            $table->foreignId('jabatan_fungsional_id')->constrained('jabatan_fungsional')->onDelete('cascade');
            $table->foreignId('grade_id')->constrained('grade')->onDelete('cascade');
            $table->foreignId('eselon_id')->constrained('eselon')->onDelete('cascade');
            $table->foreignId('parent_id')->constrained('struktur')->onDelete('cascade');
            $table->integer('jv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struktur');
    }
};
