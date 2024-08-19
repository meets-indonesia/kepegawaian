<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory;

    protected $table = 'struktur';

    protected $fillable = [
        'jabatan_struktural_id',
        'jabatan_fungsional_id',
        'grade_id',
        'eselon_id',
        'parent_id',
        'jv'
    ];
}
