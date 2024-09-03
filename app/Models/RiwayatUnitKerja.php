<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatUnitKerja extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'riwayat_unit_kerja';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pegawai_id', 'unit_kerja_id', 'tanggal_mulai'];

    /**
     * Get the pegawai that owns the RiwayatUnitKerja
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the unit_kerja that owns the RiwayatUnitKerja
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\UnitKerja
     */
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }
}
