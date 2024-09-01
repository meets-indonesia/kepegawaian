<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RiwayatMutasiResource extends JsonResource
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
            'no_sk' => $this->no_sk,
            'tanggal_sk' => $this->tanggal_sk,
            'jenis_sk' => $this->jenis_sk,
            'pegawai' => new PegawaiResource($this->whenLoaded('pegawai')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
