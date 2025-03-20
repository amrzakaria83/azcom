<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DegreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $classes = [];

        foreach ($this->studentsDegree as $key => $degree) {
            $degrees[] = array(
                'subject_title' => $degree->subject->name,
                'highest' => $degree->highest,
                'lowest' => $degree->lowest,
                'degree' => $degree->degree,
            ) ;
        }

        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'classroom'=>$this->classroom->name,
            'student'=>$this->student->name,
            'degrees'=>$degrees,
        ];
    }
}
