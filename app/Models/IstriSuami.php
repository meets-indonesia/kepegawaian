<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IstriSuami extends Model
{
    use HasFactory;

    protected $table = 'istri_suami';

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
}
