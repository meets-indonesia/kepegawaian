<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'riwayat_pendidikan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'pendidikan_id',
        'bidang_ilmu',
        'nama_sekolah',
        'tahun_selesai',
    ];

    /**
     * Get the pegawai that owns the RiwayatPendidikan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the pendidikan that owns the RiwayatPendidikan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pendidikan
     */

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }

    /**
     * Get the jurusan that owns the RiwayatPendidikan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Jurusan
     */

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
