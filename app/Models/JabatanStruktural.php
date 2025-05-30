<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanStruktural extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jabatan_struktural';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'masa', 'eselon_id', 'parent_id'];

    /**
     * Get the eselon that owns the JabatanStruktural
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eselon()
    {
        return $this->belongsTo(Eselon::class);
    }

    /**
     * Get the pegawai for the JabatanStruktural
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }

    /**
     * Get the parent jabatan (atasan)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(JabatanStruktural::class, 'parent_id');
    }

    /**
     * Get the child jabatan (bawahan)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(JabatanStruktural::class, 'parent_id');
    }

    /**
     * Get all descendants (recursive)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    /**
     * Get all ancestors (recursive)
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function ancestors()
    {
        $ancestors = collect();
        $current = $this->parent;

        while ($current) {
            $ancestors->push($current);
            $current = $current->parent;
        }

        return $ancestors;
    }
}
