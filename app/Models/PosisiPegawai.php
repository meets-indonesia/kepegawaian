<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiPegawai extends Model
{
    use HasFactory;

    protected $table = 'posisi_pegawais';
    protected $primaryKey = 'pegawai_id';
    public $incrementing = false;

    protected $fillable = [
        'posisi_id',
        'unit_kerja_id',
        'jurusan_id',
        'prodi_id',
        'atasan_id',
    ];

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function atasan()
    {
        return $this->belongsTo(PosisiPegawai::class, 'atasan_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
