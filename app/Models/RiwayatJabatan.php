<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_jabatan';

    protected $fillable = [
        'pegawai_id',
        'unit_kerja_id',
        'eselon_id',
        'jabatan_struktural_id',
        'jabatan_fungsional_id',
        'satuan_kerja',
        'jenis',
        'tmt_js',
        'akhir_eselon',
        'tmt_jf',
        'nomor_sk',
        'tanggal_sk',
    ];
}
