<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyReportResource extends JsonResource
{
    public static $wrap = null;
    
    public function toArray(Request $request): array
    {
        if ($this->link) {
            if (substr($this->link, 0, 4) != 'http') {
                $file = url('/').$this->link;
            } else {
                $file = $this->link;
            }
        } else {
            if ($this->getFirstMedia('photo')->mime_type == 'image/png' || $this->getFirstMedia('photo')->mime_type == 'image/jpg' || $this->getFirstMedia('photo')->mime_type == 'image/jpeg') {
                $file = $this->getFirstMedia('photo')->getUrl('thumb');
            } else { 
                $file = $this->getFirstMediaUrl('photo');
            }
        }


        if ($this->getMedia('photo')->count()) {
            $filetype = $this->getFirstMedia('photo')->mime_type;
        } else {
            
            if ($this->link) {
                if (substr($this->link, 0, 4) != 'http') {
                    $filetype = 'video/mp4';
                } else {
                    $filetype = null;
                }
            } else {
                $filetype = null;
            }
        }
        
        return [
            'date'=>$this->date,
            'file'=>$file,
            'name'=>$this->name ?? $this->classroom->name,
            'subject_id'=>$this->subject_id,
            'type'=> $filetype,
        ];
    }

}
