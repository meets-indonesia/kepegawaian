<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatHukumanDisiplin extends Model
{
    use HasFactory;

    protected $table = 'riwayat_hukuman_disiplins';

    protected $fillable = [
        'pegawai_id',
        'hukuman_disiplin_id',
        'tanggal_hukuman',
        'keterangan',
    ];

    /**
     * Get the pegawai that owns the RiwayatHukumanDisiplin
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    /**
     * Get the hukumanDisiplin that owns the RiwayatHukumanDisiplin
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\HukumanDisiplin
     */
    public function hukumanDisiplin()
    {
        return $this->belongsTo(HukumanDisiplin::class, 'hukuman_disiplin_id');
    }
}
