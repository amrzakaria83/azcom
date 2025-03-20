<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cut_sale extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'type_type', // 0 = center - 1 = newcustomer 
        'center_id',
        'name_ar',
        'name_en',
        'phone',
        'address', 
        'email', 
        'tax_id', 
        'area_id', 
        'lat', 
        'lng', 
        'value',
        'note',
        'status',
    ];
    public function getarea()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
