<?php

namespace App\Http\Resources;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowSchoolResource extends JsonResource
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
            'image' => $this->media->file_url ?? null,
            'address' => $this->address->link,
            'description'=>$this->description,
            'type' => $this->type->name,
            'skills' => SkillResource::collection($this->skills),
            // 'workshops' => $this->workshops,
            'scholarship' => ScholarshipResource::collection($this->scholarship),
            'workshops' => WorkshopResource::collection($this->workshops,)
        ];
    }
}
