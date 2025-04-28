<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill_sale_header extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'manger_update_id', // manger_update_id
        'cut_sale_id',
        'sale_type_id',
        'valued_time',
        'totalsellprice',
        'approv_sellprice',
        'note',
        'method_for_payment',
        'status_order',
        'note1',
        'note2',
        'note3',
        'status_requ', // 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied 
        'status',
    ];
    
    public function getcust()
    {
        return $this->belongsTo(Cut_sale::class, 'cut_sale_id');
    }
    public function getsaletype()
    {
        return $this->belongsTo(Sale_type::class, 'sale_type_id');
    }
    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
    public function getmanger()
    {
        return $this->belongsTo(Employee::class, 'manger_update_id');
    }

}
