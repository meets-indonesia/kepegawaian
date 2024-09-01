<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StrukturResource extends JsonResource
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
            'jv' => $this->jv,
            'jabatan_struktural_id' => new JabatanStrukturalResource($this->whenLoaded('jabatan_struktural')),
            'jabatan_fungsional_id' => new JabatanFungsionalResource($this->whenLoaded('jabatan_fungsional')),
            'grade_id' => new GradeResource($this->whenLoaded('grade')),
            'eselon_id' => new EselonResource($this->whenLoaded('eselon')),
            'parent_id' => new StrukturResource($this->whenLoaded('parent')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
