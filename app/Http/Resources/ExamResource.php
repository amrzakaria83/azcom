<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
Use Carbon\Carbon;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $created = Carbon::parse($this->created_at);

        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'duration'=>$this->duration,
            'subject'=>$this->subject->name,
            'date'=>$created->format("Y-m-d"),
            'time'=>$created->format("h:i a"),
        ];
    }
}
