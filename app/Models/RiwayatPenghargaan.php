<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenghargaan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penghargaan';

    protected $fillable = [
        'pegawai_id',
        'nama',
        'tanggal',
        'pemberi'
    ];
}
