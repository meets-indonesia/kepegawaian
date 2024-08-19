<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanFungsional extends Model
{
    use HasFactory;

    protected $table = 'jabatan_fungsional';

    protected $fillable = ['name', 'masa'];
}
