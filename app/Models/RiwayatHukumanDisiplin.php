<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatHukumanDisiplin extends Model
{
    use HasFactory;

    protected $table = 'riwayat_hukuman_disiplin';

    protected $fillable = [
        'pegawai_id',
        'hukuman_disiplin_id',
        'nomor_sk',
        'tanggal_sk',
        'tmt_hd',
        'masa_tahun',
        'masa_bulan',
        'akhir_hukuman',
        'golongan_ruang',
    ];
}
