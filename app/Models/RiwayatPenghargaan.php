<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenghargaan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'riwayat_penghargaan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'nama',
        'tanggal',
        'pemberi'
    ];

    /**
     * Get the pegawai that owns the RiwayatPenghargaan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
