<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'job_title'=>$this->job_title,
            'name'=>$this->name_en,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'is_active'=>$this->is_active,
            'type'=>$this->type,
            'address'=>$this->address,
            'token'=>$this->token,
        ];
    }
}
