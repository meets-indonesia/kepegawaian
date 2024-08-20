<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatHukumanDisiplin extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'riwayat_hukuman_disiplin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'hukuman_disiplin_id',
        'nomor_sk',
        'tanggal_sk',
        'tmt_hd',
        'masa_tahun',
        'masa_bulan',
        'akhir_hukuman',
        'golongan_ruang',
    ];

    /**
     * Get the pegawai that owns the RiwayatHukumanDisiplin
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the hukuman_disiplin that owns the RiwayatHukumanDisiplin
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\HukumanDisiplin
     */

    public function hukuman_disiplin()
    {
        return $this->belongsTo(HukumanDisiplin::class);
    }
}
