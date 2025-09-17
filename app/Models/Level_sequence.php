<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level_sequence extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name_en',
        'name_ar',
        'parent_id',
        'type', // 0 = sub have parent_id - 1 =  major
        'note',
        'description',
        'status',

    ];
}
