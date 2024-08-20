<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RiwayatHukumanDisiplinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'nomor_sk' => $this->nomor_sk,
            'tanggal_sk' => $this->tanggal_sk,
            'tmt_hd' => $this->tanggal_sk,
            'masa_tahun' => $this->nomor_sk,
            'masa_bulan' => $this->nomor_sk,
            'akhir_hukuman' => $this->tanggal_sk,
            'golongan_ruang' => $this->nomor_sk,
            'pegawai' => new PegawaiResource($this->whenLoaded('pegawai')),
            'hukuman_disiplin' => new HukumanDisiplinResource($this->whenLoaded('hukuman_disiplin')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
