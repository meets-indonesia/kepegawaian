<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anak';

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
}
