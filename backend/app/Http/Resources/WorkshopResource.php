<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopResource extends JsonResource
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
            'description'=>$this->description,
            'start_date'=>$this->start_date,
            'expired_date'=>$this->expired_date,
            'time'=>$this->time,    
            'user_number'=>$this->user_number 
        ];

    }
}
