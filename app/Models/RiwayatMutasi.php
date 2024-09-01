<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatMutasi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'riwayat_mutasi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'no_sk',
        'jenis',
        'fakultas_id',
        'jurusan_id',
        'prodi_id',
        'tanggal_sk'
    ];

    /**
     * Get the pegawai that owns the RiwayatMutasi
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the fakultas that owns the RiwayatMutasi
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Fakultas
     */

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    /**
     * Get the jurusan that owns the RiwayatMutasi
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Jurusan
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Get the prodi that owns the RiwayatMutasi
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Prodi
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
