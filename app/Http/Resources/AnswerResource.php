<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'exam_id'=>$this->exam_id,
            'result_id'=>$this->result_id,
            'exm_question_id'=>$this->exm_question_id,
            'answer_id'=>$this->answer_id,
            'is_correct'=>$this->is_correct,
        ];
    }
}
