<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GajiPokokResource extends JsonResource
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
            'masa_kerja' => $this->masa_kerja,
            'gaji_pokok' => $this->gaji_pokok,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
