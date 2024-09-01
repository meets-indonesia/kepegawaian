<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnakResource extends JsonResource
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
            'jenis_kelamin' => $this->jenis_kelamin,
            'pekerjaan' => $this->pekerjaan,
            'tempat_tinggal' => $this->tempat_tinggal,
            'status' => $this->status,
            'tanggal_lahir' => $this->tanggal_lahir,
            'pegawai' => new PegawaiResource($this->whenLoaded('pegawai')),
            'pendidikan' => new PendidikanResource($this->whenLoaded('pendidikan')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
