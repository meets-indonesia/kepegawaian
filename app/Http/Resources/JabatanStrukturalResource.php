<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JabatanStrukturalResource extends JsonResource
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
            'masa' => $this->masa,
            'eselon' => new EselonResource($this->whenLoaded('eselon')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
