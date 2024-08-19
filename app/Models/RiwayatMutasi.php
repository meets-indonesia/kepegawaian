<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatMutasi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_mutasi';

    protected $fillable = ['pegawai_id', 'no_sk', 'jenis', 'tanggal_sk'];
}
