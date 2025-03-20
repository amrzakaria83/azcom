<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
Use Carbon\Carbon;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $created = Carbon::parse($this->created_at);
        $files = [];
        
        if ($this->getMedia('photo')->count()) {
            foreach ($this->getMedia('photo') as $key => $file) {
                $files[] = $file->getUrl('thumb');
            }
            
        }

        if ($this->getMedia('video')->count()) {
            foreach ($this->getMedia('video') as $key => $file) {
                $files[] = $file->getUrl();
            }
        }

        return [
            'name'=>$this->name,
            'description'=>htmlspecialchars(trim(strip_tags($this->description))),
            'type'=>$this->type,
            'file'=>$files,
            'date'=>$created->format("Y-m-d h:i a"),
        ];
    }
}
