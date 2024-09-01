<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grade';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'jabatan_fungsional_id',
        'jabatan_struktural_id',
        'pendidikan_id',
        'kelompok_pegawai_id',
        'unit_kerja_id'
    ];

    /**
     * Get the jabatanFungsional that owns the Grade
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\JabatanFungsional
     */
    public function jabatanFungsional()
    {
        return $this->belongsTo(JabatanFungsional::class);
    }

    /**
     * Get the jabatanStruktural that owns the Grade
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\JabatanStruktural
     */
    public function jabatanStruktural()
    {
        return $this->belongsTo(JabatanStruktural::class);
    }

    /**
     * Get the pendidikan that owns the Grade
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pendidikan
     */
    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }

    /**
     * Get the kelompokPegawai that owns the Grade
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\KelompokPegawai
     */
    public function kelompokPegawai()
    {
        return $this->belongsTo(KelompokPegawai::class);
    }

    /**
     * Get the unitKerja that owns the Grade
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\UnitKerja
     */
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }
}
