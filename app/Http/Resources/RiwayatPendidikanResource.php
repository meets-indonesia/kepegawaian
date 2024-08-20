<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RiwayatPendidikanResource extends JsonResource
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
            'jurusan_id' => $this->jurusan_id,
            'tanggal_lulus' => $this->tanggal_lulus,
            'nama_sekolah' => $this->nama_sekolah,
            'gelar_depan' => $this->gelar_depan,
            'gelar_belakang' => $this->gelar_belakang,
            'pegawai' => new PegawaiResource($this->whenLoaded('pegawai')),
            'pendidikan' => new PendidikanResource($this->whenLoaded('pendidikan')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
