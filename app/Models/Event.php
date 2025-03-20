<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $fillable = [
        'emp_id', // emp_add
        'type_id',
        'name_en',
        'from_time',
        'to_time',
        'prod_id',
        'note',
        'status',
    ];
    public function geteventtype()
    {
        return $this->belongsTo(Event_type::class, 'type_id');
    }
    
    public function getContents()
    {
        return $this->HasMany(Event_content::class, 'event_id');
    }

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('photo')
        ->singleFile();

        $this->addMediaConversion('thumb')
        ->keepOriginalImageFormat()
        >width(600);
    }
}
