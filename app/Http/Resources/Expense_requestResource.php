<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Expense_requestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->statusresponse == 0) {
            $statusresponse = 'waitting';
        } else if ($this->vacationrequest == 1) {
            $statusresponse = 'approved';
        } else if ($this->vacationrequest == 2) {
            $statusresponse = 'rejected';
        } else {
            $statusresponse = 'delayed';
        }
        
        return [
            'id'=>$this->id,
            'value'=>$this->value,
            'note'=>$this->note,
            'statusresponse'=>$statusresponse,
            'type'=>$this->gettype->name_en,
        ];
    }
}
