<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'country_id',
        'name_en',
        'egy_or_uea_id',
        'note',
        'status',
    ]; 

    public function getcity()
    {
        if ($this->country_id === "EGY"){ 
        return $this->belongsTo(City::class, 'egy_or_uea_id');
    } elseif ($this->country_id === "UAE") {
        return $this->belongsTo(Emirate::class, 'egy_or_uea_id');
    }
    }
    public function country()
{
    return $this->belongsTo(Country::class, 'country_id');
}
}
