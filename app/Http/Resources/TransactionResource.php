<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
Use Carbon\Carbon;

class TransactionResource extends JsonResource
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
            'name'=>$this->getcust->name_en,
            'model'=>$this->model_name,
            'value'=>$this->total_value,
            'date'=>$created->format("d-m-Y")
        ];
    }
}
