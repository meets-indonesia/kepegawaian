<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PegawaiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nip' => $this->nip,
            'name' => $this->name,
            'email' => $this->email,
            'tamat_cpns' => $this->tamat_cpns,
            'tamat_pns' => $this->tamat_pns,
            'unit_kerja' => new UnitKerjaResource($this->whenLoaded('unit_kerja')),
            'jabatan_struktural' => new JabatanStrukturalResource($this->whenLoaded('jabatan_struktural')),
            'jabatan_fungsional' => new JabatanFungsionalResource($this->whenLoaded('jabatan_fungsional')),
            'pendidikan' => new PendidikanResource($this->whenLoaded('pendidikan')),
            'grade' => new GradeResource($this->whenLoaded('grade')),
            'golongan' => new GolonganResource($this->whenLoaded('golongan')),
            'kelompok_pegawai' => new KelompokPegawaiResource($this->whenLoaded('kelompok_pegawai')),
            'jenis_pegawai' => new JenisPegawaiResource($this->whenLoaded('jenis_pegawai')),
            'jurusan' => new JurusanResource($this->whenLoaded('jurusan')),
            'prodi' => new ProdiResource($this->whenLoaded('prodi')),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
