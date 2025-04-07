<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trans_cust extends Model
{
    // model_name is 1- 'Cust_collection' 2 - 'Refund_sale'
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'cust_id',
        'model_name', 
        'id_model', 
        'total_value', // required
        'status_trans', // 0 = increased creadite - 1 = decreased creadite 
        'note',
        'value_befor',
        'status',
        'detal_cash',// json
        
    ];
    public function getcust()
    {
        return $this->belongsTo(Cut_sale::class, 'cust_id');
    }

}
