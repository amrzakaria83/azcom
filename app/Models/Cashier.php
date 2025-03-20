<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cashier extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'acctree_id',
        'name_ar',
        'name_en',
        'value', 
        'description',
        'status',
    ];
    public function getacctree()
    {
        return $this->belongsTo(Account_tree::class, 'acctree_id');
    }
}
