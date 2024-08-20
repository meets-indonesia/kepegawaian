<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anak';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'pendidikan_id',
        'name',
        'jenis_kelamin',
        'pekerjaan',
        'tempat_tinggal',
        'tanggal_lahir',
        'status'
    ];

    /**
     * Get the pegawai that owns the Anak
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Get the pendidikan that owns the Anak
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pendidikan
     */
    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }
}
