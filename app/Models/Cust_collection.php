<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cust_collection extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'cust_id',
        'value',
        'note',
        'balance_befor', // balance for Cut_sale is  value
        'status',
    ];
    public function getcust()
    {
        return $this->belongsTo(Cut_sale::class, 'cust_id');
    }

}
