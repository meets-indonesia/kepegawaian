<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fakultas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the prodi for the Fakultas
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\Prodi
     */
    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }

    /**
     * Get the pegawai for the Fakultas
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\Pegawai
     */

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
