<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiPokok extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gaji_pokok';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'golongan_id',
        'masa_kerja',
        'gaji_pokok'
    ];

    /**
     * Get the golongan that owns the GajiPokok
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Golongan
     */
    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }
}
