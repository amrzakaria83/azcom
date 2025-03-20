<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Working_hour extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'id_model', //id for model which whorking hours
        'model_name', // name for model which whorking hours
        'from_time',
        'to_time',
        'dynamic_work', // 0 = days - 1 = unregular - 2 = 24 hours
        'on_workrule', // 0 = weekly - 1 = unregular - 2 = 7 days work
        'work_days', // json (0 = Saturday - 1 = Sunday - 2 = Monday - 3 = Tuesday - 4 = Wednesday - 5 = Thursday - 6 =  Friday)
        'status',
    ];
}
