<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiPegawai extends Model
{
    use HasFactory;

    protected $table = 'posisi_pegawais';
    protected $primaryKey = 'pegawai_id';
    public $incrementing = false;

    protected $fillable = [
        'posisi_id',
        'unit_kerja_id',
        'jurusan_id',
        'prodi_id',
        'atasan_id',
    ];

    /**
     * Get the posisi that owns the PosisiPegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Posisi
     */
    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id');
    }

    /**
     * Get the unitKerja that owns the PosisiPegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\UnitKerja
     */
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    /**
     * Get the jurusan that owns the PosisiPegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Jurusan
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    /**
     * Get the prodi that owns the PosisiPegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Prodi
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    /**
     * Get the atasan that owns the PosisiPegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\PosisiPegawai
     */
    public function atasan()
    {
        return $this->belongsTo(PosisiPegawai::class, 'atasan_id');
    }

    /**
     * Get the pegawai that owns the PosisiPegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
