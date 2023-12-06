<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowScholarshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image' => $this->media->file_url ?? null,
            'full' => $this-> full,
            'user_number' => $this->user_number,
            'description'=>$this->description,
            'post_date'=>$this->post_date,
            'expired_date'=>$this->expired_date,
            'description'=>$this->description,
            'school_id'=>new SchoolResource($this->school),
            'skill_id'=>new SkillResource($this->skill),
        ];
    }
}
