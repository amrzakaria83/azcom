<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'governorate_id',
        'city_name_ar',
        'city_name_en',
        'countrycodealpha3',

    ];
    public function cities()
    {
        return $this->hasOne(Governorate::class);
    }
    public function getgovernorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

}
