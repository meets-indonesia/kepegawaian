<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pegawai';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nip',
        'name',
        'email',
        'golongan_id',
        'kelompok_pegawai_id',
        'jenis_pegawai_id',
        'unit_kerja_id',
        'jurusan_id',
        'prodi_id',
        'grade_id',
        'tamat_cpns',
        'tamat_pns',
        'pendidikan_id',
        'jabatan_fungsional_id',
        'jabatan_struktural_id'
    ];

    /**
     * Get the golongan that owns the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Golongan
     */
    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }

    /**
     * Get the kelompok_pegawai that owns the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\KelompokPegawai
     */
    public function kelompok_pegawai()
    {
        return $this->belongsTo(KelompokPegawai::class);
    }

    /**
     * Get the jenis_pegawai that owns the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\JenisPegawai
     */
    public function jenis_pegawai()
    {
        return $this->belongsTo(JenisPegawai::class);
    }

    /**
     * Get the unit_kerja that owns the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\UnitKerja
     */
    public function unit_kerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    /**
     * Get the jurusan that owns the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Jurusan
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Get the prodi that owns the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Prodi
     */

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    /**
     * Get the grade that owns the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Grade
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * Get the pendidikan that owns the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\Pendidikan
     */

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }

    /**
     * Get the jabatan_fungsional that owns the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\JabatanFungsional
     */

    public function jabatan_fungsional()
    {
        return $this->belongsTo(JabatanFungsional::class);
    }

    /**
     * Get the jabatan_struktural that owns the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @var \App\Models\JabatanStruktural
     */

    public function jabatan_struktural()
    {
        return $this->belongsTo(JabatanStruktural::class);
    }

    /**
     * Get the anak for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\Anak
     */

    public function anak()
    {
        return $this->hasMany(Anak::class);
    }

    /**
     * Get the latihan_jabatan for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\LatihanJabatan
     */

    /**
     * Get the latihan_jabatan for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\LatihanJabatan
     */
    public function latihan_jabatan()
    {
        return $this->hasMany(LatihanJabatan::class);
    }

    /**
     * Get the riwayat_golongan for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatGolongan
     */
    public function riwayatGolongan()
    {
        return $this->hasMany(RiwayatGolongan::class);
    }

    /**
     * Get the riwayat_kelompok_pegawai for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatKelompokPegawai
     */
    public function riwayatKelompokPegawai()
    {
        return $this->hasMany(RiwayatKelompokPegawai::class);
    }

    /**
     * Get the riwayat_jenis_pegawai for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatJenisPegawai
     */
    public function riwayatJenisPegawai()
    {
        return $this->hasMany(RiwayatJenisPegawai::class);
    }

    /**
     * Get the riwayat_pendidikan for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatPendidikan
     */

    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class);
    }

    /**
     * Get the riwayat_jabatan_struktural for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatJabatanStruktural
     */
    public function riwayatJabatanStruktural()
    {
        return $this->hasMany(RiwayatJabatanStruktural::class);
    }


    /**
     * Get the riwayat_jabatan_fungsional for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatJabatanFungsional
     */
    public function riwayatJabatanFungsional()
    {
        return $this->hasMany(RiwayatJabatanFungsional::class);
    }

    /**
     * Get the riwayat_mutasi for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatMutasi
     */
    public function riwayatMutasi()
    {
        return $this->hasMany(RiwayatMutasi::class);
    }

    /**
     * Get the riwayat_grade for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatGrade
     */
    public function riwayatGrade()
    {
        return $this->hasMany(RiwayatGrade::class);
    }

    /**
     * Get the riwayat_hukuman_disiplin for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatHukumanDisiplin
     */
    public function riwayatHukumanDisiplin()
    {
        return $this->hasMany(RiwayatHukumanDisiplin::class);
    }

    /**
     * Get the riwayat_penghargaan for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatPenghargaan
     */
    public function riwayatPenghargaan()
    {
        return $this->hasMany(RiwayatPenghargaan::class);
    }

    /**
     * Get the posisi_pegawai for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\PosisiPegawai
     */

    public function posisi_pegawai()
    {
        return $this->hasMany(PosisiPegawai::class);
    }


    /**
     * Get the riwayat_unit_kerja for the Pegawai
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @var \App\Models\RiwayatUnitKerja
     */
    public function riwayatUnitKerja()
    {
        return $this->hasMany(RiwayatUnitKerja::class);
    }
}
