<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account_tree extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'emp_id',
        'name_ar',
        'name_en',
        'parent_id',
        'type', //0 = sub have parent_id - 1 = major advance_payment
        'type_account', // 1 = debite - 0 = creadite 
        'value',
        'targete',
        'parent_targete',
        'parent_value', // for clossing and sub item
        'status',
        'note',
    ];
}
