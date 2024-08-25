<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatanFungsional extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'riwayat_pangkat';

    // fillable
    protected $fillable = [
        'pegawai_id',
        'jabatan_fungsional_id',
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
     * Get the jabatanFungsional that owns the RiwayatPangkat
     */

    public function jabatanFungsional()
    {
        return $this->belongsTo(JabatanFungsional::class);
    }
}
