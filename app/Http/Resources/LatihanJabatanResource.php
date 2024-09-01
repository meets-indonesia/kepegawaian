<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LatihanJabatanResource extends JsonResource
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
            'name' => $this->name,
            'tahun' => $this->tahun,
            'jam' => $this->jam,
            'sertifikat' => $this->sertifikat,
            'pegawai' => new PegawaiResource($this->whenLoaded('pegawai')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
