<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatihanJabatan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'latihan_jabatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'nama',
        'tahun',
        'jam',
        'sertifikat',
    ];

    /**
     * Get the pegawai that owns the LatihanJabatan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
