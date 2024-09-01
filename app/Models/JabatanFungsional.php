<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanFungsional extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jabatan_fungsional';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'masa'];

    /**
     * Get the pegawai for the JabatanFungsional
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
