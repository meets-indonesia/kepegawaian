<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'riwayat_jabatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'unit_kerja_id',
        'eselon_id',
        'jabatan_struktural_id',
        'jabatan_fungsional_id',
        'satuan_kerja',
        'jenis',
        'tmt_js',
        'akhir_eselon',
        'tmt_jf',
        'nomor_sk',
        'tanggal_sk',
    ];

    /**
     * Get the pegawai that owns the RiwayatJabatan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the unit_kerja that owns the RiwayatJabatan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\UnitKerja
     */

    public function unit_kerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    /**
     * Get the eselon that owns the RiwayatJabatan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Eselon
     */

    public function eselon()
    {
        return $this->belongsTo(Eselon::class);
    }

    /**
     * Get the jabatan_struktural that owns the RiwayatJabatan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\JabatanStruktural
     */

    public function jabatan_struktural()
    {
        return $this->belongsTo(JabatanStruktural::class);
    }

    /**
     * Get the jabatan_fungsional that owns the RiwayatJabatan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\JabatanFungsional
     */

    public function jabatan_fungsional()
    {
        return $this->belongsTo(JabatanFungsional::class);
    }
}
