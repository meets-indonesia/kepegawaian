<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diklat extends Model
{
    use HasFactory;

    protected $table = 'diklat';

    protected $fillable = [
        'pegawai_id',
        'name',
        'jumlah_jam',
        'penyelenggara',
        'tempat',
        'angkatan',
        'tahun',
        'nomor',
        'tanggal_sttp',
        'sertifikat'
    ];
}
