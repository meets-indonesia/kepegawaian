<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'golongan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'golongan'];

    /**
     * Get the gajiPokok for the Golongan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\GajiPokok
     */
    public function gajiPokok()
    {
        return $this->hasMany(GajiPokok::class);
    }
}
