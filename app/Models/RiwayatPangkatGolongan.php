<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPangkatGolongan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'riwayat_pangkat_golongan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'unit_kerja_id',
        'lokasi_kerja_id',
        'golongan_ruang',
        'tmt_golongan',
        'tanggal_sk',
        'nomor_sk'
    ];

    /**
     * Get the pegawai that owns the RiwayatPangkatGolongan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the unit_kerja that owns the RiwayatPangkatGolongan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\UnitKerja
     */

    public function unit_kerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    /**
     * Get the lokasi_kerja that owns the RiwayatPangkatGolongan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\LokasiKerja
     */

    public function lokasi_kerja()
    {
        return $this->belongsTo(LokasiKerja::class);
    }
}
