<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\App;

class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name_ar','name_en','email','email2','phone','phone2','whatsapp','address',
        'address2','location','facebook','twitter','youtube','linkedin','instagram','snapchat',
        'keywords_ar','keywords_en','description_ar','description_en','tax_num','commercial_num',
        'currency','pdf','lat','lng','payment','tiktok'
    ];

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('logo')
        ->singleFile();

        $this->addMediaConversion('logothumb')
        ->keepOriginalImageFormat()
        ->height(110);

        $this->addMediaCollection('logoDark')
        ->singleFile();

        $this->addMediaConversion('logoDarkthumb')
        ->keepOriginalImageFormat()
        ->height(110);

        $this->addMediaCollection('fav')
        ->singleFile();

        $this->addMediaConversion('favthumb')
        ->keepOriginalImageFormat()
        ->crop('crop-center', 96, 96);

        $this->addMediaCollection('breadcrumb')
        ->singleFile();

        $this->addMediaConversion('breadcrumbthumb')
        ->keepOriginalImageFormat()
        ->crop('crop-center', 1800, 500);

    }

    public function getAppendNameAttribute()
    {
        if ($locale = App::getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function getAppendKeywordsAttribute()
    {
        if ($locale = App::getLocale() == "ar") {
            return $this->keywords_ar;
        } else {
            return $this->keywords_en;
        }
    }

    public function getAppendDescriptionAttribute()
    {
        if ($locale = App::getLocale() == "ar") {
            return $this->description_ar;
        } else {
            return $this->description_en;
        }
    }
}
