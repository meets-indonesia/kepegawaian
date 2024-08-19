<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiPokok extends Model
{
    use HasFactory;

    protected $table = 'gaji_pokok';

    protected $fillable = [
        'golongan_id',
        'masa_kerja',
        'gaji_pokok'
    ];
}
