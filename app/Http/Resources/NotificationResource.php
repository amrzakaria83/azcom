<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
Use Carbon\Carbon;

class NotificationResource extends JsonResource
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
            'title'=>$this->title,
            'body'=>$this->body,
            'type'=>$this->type,
            'type_id'=>$this->type_id,
            'date'=>$created->format("Y-m-d h:i a"),
        ];
    }
}
