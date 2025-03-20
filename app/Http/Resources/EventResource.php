<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'name'=>$this->name_en,
            'from_time'=>$this->from_time,
            'to_time'=>$this->to_time,
            'note'=>$this->note,
            'type_id'=>$this->geteventtype->name_en,
            'contents'=>$this->getContents,
        ];
    }
}
