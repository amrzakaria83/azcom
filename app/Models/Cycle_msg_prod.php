<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycle_msg_prod extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'prod_id',
        'title',
        'description',
        'valued_to',
        'status',
    ];
    public function getprod()
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }
}
