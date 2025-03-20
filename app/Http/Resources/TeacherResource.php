<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'job_title'=>$this->job_title,
            'count'=>$this->msgcount->count(),
            'phone'=>$this->phone,
            'photo'=>$this->getFirstMediaUrl('profile'),
        ];
    }
}
