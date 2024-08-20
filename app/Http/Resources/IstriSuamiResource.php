<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IstriSuamiResource extends JsonResource
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
            'nama' => $this->nama,
            'pekerjaan' => $this->pekerjaan,
            'tempat_tinggal' => $this->tempat_tinggal,
            'status' => $this->status,
            'tanggal_lahir' => $this->tanggal_lahir,
            'tanggal_nikah' => $this->tanggal_nikah,
            'pegawai' => new PegawaiResource($this->whenLoaded('pegawai')),
            'pendidikan' => new PendidikanResource($this->whenLoaded('pendidikan')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
