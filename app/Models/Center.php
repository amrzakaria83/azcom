<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Center extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'name_en',
        'type_id',
        'area_id',

        'phone',
        'phone2',
        'landline',
        'landline2',
        'email',
        'website',
        
        'address',
        'lat',
        'lng',
        'map_location',
        'note',
        'status',
    ];
    public function gettype()
    {
        return $this->belongsTo(Type_center::class, 'type_id');
    }
    public function getarea()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
