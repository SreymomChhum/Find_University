<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowSkillResource extends JsonResource
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
                'description' => $this->description,
                'subjects' => SubjectResource::collection($this->subjects),
                'school_id' => SchoolResource::collection( $this->schools),
                'image' => $this->media->file_url ?? null,
                'school_id' => SchoolResource::collection($this->schools) 
            ];
    }
}
