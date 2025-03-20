<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
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
            'exam_id'=>$this->exam_id,
            'name'=>$this->exam->name,
            'duration'=>$this->exam->duration,
            'subject'=>$this->exam->subject->name,
            'result'=>$this->result,
            'total'=>$this->total,
            'date'=>$this->date,
            'start_time'=>$this->start_time,
            'end_time'=>$this->end_time,
        ];
    }
}
