<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPangkatGolongan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pangkat_golongan';

    protected $fillable = [
        'pegawai_id',
        'unit_kerja_id',
        'lokasi_kerja_id',
        'golongan_ruang',
        'tmt_golongan',
        'tanggal_sk',
        'nomor_sk'
    ];
}
