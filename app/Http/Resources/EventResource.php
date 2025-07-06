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
            'checkin_time'=>$this->getAttends->from_time ?? '0',
            'lat_checkin'=>$this->getAttends->lat_checkin ?? '0',
            'lng_checkin'=>$this->getAttends->lng_checkin ?? '0',
            'end_time'=>$this->getAttends->end_time ?? '0',
            'lat_checkout'=>$this->getAttends->lat_checkout ?? '0',
            'lng_checkout'=>$this->getAttends->lng_checkout ?? '0',
        ];
    }
}
