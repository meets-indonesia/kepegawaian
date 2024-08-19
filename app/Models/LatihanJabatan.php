<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatihanJabatan extends Model
{
    use HasFactory;

    protected $table = 'latihan_jabatan';

    protected $fillable = [
        'pegawai_id',
        'nama',
        'tahun',
        'jam',
        'sertifikat',
    ];
}
