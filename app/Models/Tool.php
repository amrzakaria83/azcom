<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tool extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'empreceved_id',
        'name_en',
        'type_tool_id',
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
        ->crop('crop-center', 300, 300);
    }
    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'empreceved_id');
    }
    public function gettype()
    {
        return $this->belongsTo(Type_tool::class, 'type_tool_id');
    }

}
