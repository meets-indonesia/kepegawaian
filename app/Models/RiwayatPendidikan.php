<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pendidikan';

    protected $fillable = [
        'pegawai_id',
        'pendidikan_id',
        'jurusan_id',
        'tanggal_lulus',
        'nama_sekolah',
        'gelar_depan',
        'gelar_belakang'
    ];
}
