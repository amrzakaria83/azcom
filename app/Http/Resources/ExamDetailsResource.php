<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
Use Carbon\Carbon;

class ExamDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $created = Carbon::parse($this->created_at);
        $answer_list = [];
        
        foreach($this->question->answers as $key => $item) {
            $answer_list[] = [
                'id' => $item->id,
                'name' => $item->name,
                'is_correct' => $item->is_correct,
                'question_id' => $item->question_id,
                'file' => $item->getFirstMediaUrl('photo'),
            ];
        }

        return [
            'id'=>$this->id,
            'exam_id'=>$this->exam_id,
            'question'=>$this->question->name,
            'question_file'=>$this->question->getFirstMediaUrl('photo'),
            'answers'=>$answer_list,
        ];
    }
}
