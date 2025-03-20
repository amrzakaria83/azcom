<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Technical_support extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia, SoftDeletes;
    
    protected $fillable = [
        'emp_id',
        'title',
        'discreption',
        'status',//0 = active - 1 = resolve - 2 = canceled 
    ];
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('t_support')
        ->singleFile();
        // ->multiple();

        // $this->addMediaConversion('thumb')
        // ->crop('crop-center', 100, 100);
    }

}
