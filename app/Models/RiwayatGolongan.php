<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatGolongan extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'riwayat_golongan';

    // fillable
    protected $fillable = [
        'pegawai_id',
        'golongan_id',
        'tahun_mulai',
    ];

    /**
     * Get the pegawai that owns the RiwayatGolongan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the golongan that owns the RiwayatGolongan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Golongan
     */
    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }
}
