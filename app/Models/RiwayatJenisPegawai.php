<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJenisPegawai extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'riwayat_jenis_pegawai';

    // fillable
    protected $fillable = [
        'pegawai_id',
        'jenis_pegawai_id',
        'tahun_mulai',
    ];

    /**
     * Get the pegawai that owns the RiwayatJenisPegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the jenis_pegawai that owns the RiwayatJenisPegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\JenisPegawai
     */
    public function jenis_pegawai()
    {
        return $this->belongsTo(JenisPegawai::class);
    }
}
