<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name_en'=>$this->append_name,
            'email'=>$this->email,
            'email2'=>$this->email2,
            'phone'=>$this->phone,
            'phone2'=>$this->phone2,
            'whatsapp'=>$this->whatsapp,
            'address'=>$this->address,
            'address2'=>$this->address2,
            'location'=>$this->location,
            'facebook'=>$this->facebook,
            'twitter'=>$this->twitter,
            'youtube'=>$this->youtube,
            'linkedin'=>$this->linkedin,
            'instagram'=>$this->instagram,
            'snapchat'=>$this->snapchat,
            'tiktok'=>$this->tiktok,
        ];
    }
}
