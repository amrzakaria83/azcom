<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'name_en', 
        'sell_price', 
        'percent',
        'description',
        'note',
        'status',
        
    ];
    
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('file')
        // ->multipleFiles()
        // ->maxNumberOfFiles(10)
        ->singleFile(); 

        $this->addMediaConversion('thumb')
        ->keepOriginalImageFormat()
        ->crop('crop-center', 500, 500);
    }

}
