<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Contact extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add 
        'social_id',
        'contractdr_id',
        'typecont_id',
        'name_en',
        'phone',
        'phone2',
        'landline',
        'address',
        'birth_date',
        'gender', // 0 = male - 1 = female - 2 = other 
        'marital_status', // 0 = singel - 1 = married - 2 = divorced  - 3 = widow - 4 = married more 1
        'email',
        'website',
        'facebook',
        'socialmedia', // other facebook
        'note',
        'speciality_id', // json
        'preferd_gift_brand',  // json
        'university_degree',
        'scientific_degree',
        'preferd_readding',
        'preferd_gift',
        'preferd_service',
        'description',
        'status',
    ];
    
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('contact')
        // ->multipleFiles()
        // ->maxNumberOfFiles(10)
        ->singleFile(); 

        $this->addMediaConversion('thumb')
        ->keepOriginalImageFormat()
        ->crop('crop-center', 200, 200);
    }
    public function getsocial()
    {
        return $this->belongsTo(Social_styl::class, 'social_id');
    }
}
