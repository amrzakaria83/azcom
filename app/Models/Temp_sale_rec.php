<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Temp_sale_rec extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'cut_sale_id',
        'sale_type_id',
        'product_id',
        'valued_time',
        'percent',
        'quantityproduc',
        'sellpriceproduct',
        'sellpriceph', // sellpriceproduct * percent
        'totalsellprice', // sellpricetotal
        'note',
        'method_for_payment',
        'note1',
        'note2',
        'note3',
        'status_order',
        'status_order_req', //0 = request - 1 = approved - 2 = cancel - 3 = nextstep
        'parent_order',
        'status',
    ]; 
    public function getprod()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getcust()
    {
        return $this->belongsTo(Cut_sale::class, 'cut_sale_id');
    }
    public function getsaletype()
    {
        return $this->belongsTo(Sale_type::class, 'sale_type_id');
    }
}
