<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'struktur';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jabatan_struktural_id',
        'jabatan_fungsional_id',
        'grade_id',
        'eselon_id',
        'parent_id',
        'jv'
    ];

    /**
     * Get the jabatan_struktural that owns the Struktur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\JabatanStruktural
     */
    public function jabatan_struktural()
    {
        return $this->belongsTo(JabatanStruktural::class);
    }

    /**
     * Get the jabatan_fungsional that owns the Struktur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\JabatanFungsional
     */
    public function jabatan_fungsional()
    {
        return $this->belongsTo(JabatanFungsional::class);
    }

    /**
     * Get the grade that owns the Struktur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Grade
     */

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * Get the eselon that owns the Struktur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Eselon
     */

    public function eselon()
    {
        return $this->belongsTo(Eselon::class);
    }

    /**
     * Get the parent that owns the Struktur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Struktur
     */

    public function parent()
    {
        return $this->belongsTo(Struktur::class, 'parent_id');
    }

    /**
     * Get the child that owns the Struktur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\Struktur
     */

    public function child()
    {
        return $this->hasMany(Struktur::class, 'parent_id');
    }
}
