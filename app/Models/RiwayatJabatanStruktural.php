<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatanStruktural extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'riwayat_jabatan_struktural';

    // fillable
    protected $fillable = [
        'pegawai_id',
        'jabatan_struktural_id',
        'tahun_mulai',
        'tahun_selesai',
    ];

    /**
     * Get the pegawai that owns the RiwayatPangkat
     */

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the jabatanStruktural that owns the RiwayatPangkat
     */

    public function jabatanStruktural()
    {
        return $this->belongsTo(JabatanStruktural::class);
    }
}
