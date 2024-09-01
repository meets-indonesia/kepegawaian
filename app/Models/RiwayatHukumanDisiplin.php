<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatHukumanDisiplin extends Model
{
    use HasFactory;

    protected $table = 'riwayat_hukuman_disiplins';

    protected $fillable = [
        'pegawai_id',
        'hukuman_disiplin_id',
        'tanggal_hukuman',
        'keterangan',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function hukumanDisiplin()
    {
        return $this->belongsTo(HukumanDisiplin::class, 'hukuman_disiplin_id');
    }
}
