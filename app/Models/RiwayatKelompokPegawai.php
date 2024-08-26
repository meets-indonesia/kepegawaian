<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKelompokPegawai extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'riwayat_kelompok_pegawai';

    // fillable
    protected $fillable = [
        'pegawai_id',
        'kelompok_pegawai_id',
        'tahun_mulai',
    ];

    /**
     * Get the pegawai that owns the RiwayatKelompokPegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the kelompok_pegawai that owns the RiwayatKelompokPegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\KelompokPegawai
     */
    public function kelompok_pegawai()
    {
        return $this->belongsTo(KelompokPegawai::class);
    }
}
