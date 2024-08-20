<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RiwayatJabatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'satuan_kerja' => $this->satuan_kerja,
            'jenis' => $this->jenis,
            'tmt_js' => $this->tmt_js,
            'akhir_eselon' => $this->akhir_eselon,
            'tmt_jf' => $this->tmt_jf,
            'nomor_sk' => $this->nomor_sk,
            'tanggal_sk' => $this->tanggal_sk,
            'pegawai' => new PegawaiResource($this->whenLoaded('pegawai')),
            'unit_kerja' => new UnitKerjaResource($this->whenLoaded('unit_kerja')),
            'eselon' => new EselonResource($this->whenLoaded('eselon')),
            'jabatan_struktural' => new JabatanStrukturalResource($this->whenLoaded('jabatan_struktural')),
            'jabatan_fungsional' => new JabatanFungsionalResource($this->whenLoaded('jabatan_fungsional')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
