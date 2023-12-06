<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowWorkShopResource extends JsonResource
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
            'address'=> new AddressResource($this->address),
            'start_date' => $this->start_date,
            'expired_date' => $this->expired_date,
            'description' => $this->description,
            'time' => $this->time,
            'user_number' => $this->user_number,
            'full' => $this->full,
            'school_id' => new SchoolResource($this->school)
        ];
    }
}
