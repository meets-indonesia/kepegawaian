<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IstriSuami extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'istri_suami';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'pendidikan_id',
        'nama',
        'tanggal_lahir',
        'tanggal_nikah',
        'pekerjaan',
        'tempat_tinggal',
        'status',
    ];

    /**
     * Get the pegawai that owns the IstriSuami
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the pendidikan that owns the IstriSuami
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pendidikan
     */
    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }
}
