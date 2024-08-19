<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grade';

    protected $fillable = ['name', 'value', 'jabatan_fungsional_id', 'jabatan_struktural_id', 'pendidikan_id', 'kelompok_pegawai_id', 'unit_kerja_id'];
}
