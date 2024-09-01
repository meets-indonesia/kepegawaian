<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanStruktural extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jabatan_struktural';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'masa', 'eselon_id'];

    /**
     * Get the eselon that owns the JabatanStruktural
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Eselon
     */
    public function eselon()
    {
        return $this->belongsTo(Eselon::class);
    }

    /**
     * Get the pegawai for the JabatanStruktural
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
