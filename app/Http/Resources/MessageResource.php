<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
Use Carbon\Carbon;

class MessageResource extends JsonResource
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
            'id'=>$this->id,
            'message'=>$this->message,
            'status'=>$this->status,
            'sender_type'=>$this->sender_type,
            'sender_id'=>$this->sender_id,
            'receiver_type'=>$this->receiver_type,
            'receiver_id'=>$this->receiver_id,
            'date'=>$created->format("Y-m-d"),
            'time'=>$created->format("h:i a"),
        ];
    }
}
