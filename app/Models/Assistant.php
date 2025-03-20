<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Assistant extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'center_id',
        'name_en',
        'phone',
        'phone2',
        'email',
        'address',
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
        ->crop('crop-center', 200, 200);
    }

    public function getcenter()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }
}
