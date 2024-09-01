<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RiwayatPangkatGolonganResource extends JsonResource
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
            'golongan_ruang' => $this->golongan_ruang,
            'tmt_golongan' => $this->tmt_golongan,
            'tanggal_sk' => $this->tanggal_sk,
            'nomor_sk' => $this->nomor_sk,
            'lokasi_kerja' => new LokasiKerjaResource($this->whenLoaded('lokasi_kerja')),
            'unit_kerja' => new UnitKerjaResource($this->whenLoaded('unit_kerja')),
            'pegawai' => new PegawaiResource($this->whenLoaded('pegawai')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
