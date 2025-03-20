<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
Use Carbon\Carbon;

class AbsenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $created = Carbon::parse($this->date);

        return [
            'id'=>$this->id,
            'note'=>$this->note,
            'dateday'=>intval($created->format("d")),
            'datemonth'=>intval($created->format("m")),
            'dateyear'=>intval($created->format("Y")),
        ];
    }
}
