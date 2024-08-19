<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'nip',
        'name',
        'email',
        'golongan_id',
        'kelompok_pegawai_id',
        'jenis_pegawai_id',
        'unit_kerja_id',
        'jurusan_id',
        'prodi_id',
        'grade_id',
        'tamat_cpns',
        'tamat_pns',
        'pendidikan_id',
        'jabatan_fungsional_id',
        'jabatan_struktural_id'
    ];
}
