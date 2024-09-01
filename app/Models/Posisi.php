<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    use HasFactory;

    protected $fillable = ['posisi'];

    public function pegawai()
    {
        return $this->hasMany(PosisiPegawai::class);
    }
}
