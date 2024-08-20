<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prodi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['jurusan_id', 'name'];

    /**
     * Get the jurusan that owns the Prodi
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Jurusan
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Get the pegawai for the Prodi
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
