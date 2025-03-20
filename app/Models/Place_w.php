<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place_w extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'contact_id',
        'center_id',
        'note',
        'from_time',
        'to_time',
        'dynamic_work', // 0 = hours - 1 = unregular - 2 = 24 hours
        'on_workrule', // 0 = weekly - 1 = unregular - 2 = 7 days work
        'work_days', // json_encode 0 = Saturday - 1 = Sunday - 2 = Monday - 3 = Tuesday - 4 = Wednesday - 5 = Thursday - 6 =  Friday
        'status',
    ];
    
    public function getcontact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function getcenter()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

}
