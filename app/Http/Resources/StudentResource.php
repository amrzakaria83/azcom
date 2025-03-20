<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $classes = [];

        foreach ($this->classes as $key => $class) {
            $classes[] = array(
                'classroom_id' => $class->classroom_id,
                'classroom_title' => $class->classroom->name,
                'classroom_meet' => $class->classroom->meet_link,
            ) ;
        }

        return [
            'id'=>$this->id,
            'classes'=>$classes,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'mother_num'=>$this->mother_num,
            'father_num'=>$this->father_num,
            'address'=>$this->address,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'token'=>$this->user->token,
            'user_id'=>$this->user->id,
        ];
    }
}
