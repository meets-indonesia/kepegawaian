<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'unit_kerja';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the pegawai for the UnitKerja
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\Pegawai
     */

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }


    /**
     * Get the riwayat_jabatan for the UnitKerja
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatJabatan
     */

    public function riwayatJabatan()
    {
        return $this->hasMany(RiwayatJabatan::class);
    }
}
