<?php

namespace App\Http\Resources;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolUserResource extends JsonResource
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
            'user_id'=> new UserResource($this->user),
            // 'skill_id'=>new SkillSchoolResource($this->skill_id),
            'skill_id'=> $this->skill_id,
            'study_level'=> $this->study_level,
            'year'=>$this->year,
            'school_id'=>$this->school_id,
            'accept'=>$this->accept,
        ];
    }
}
