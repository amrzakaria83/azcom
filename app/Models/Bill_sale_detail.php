<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill_sale_detail extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add 
        'product_id',
        'bill_sale_header_id',
        'quantityproduc',
        'approv_quantity',
        'approv_sellpriceproduct',
        'approv_percent',
        'sellpriceproduct',
        'percent',
        'sellpriceph',
        'note',
        'status',
        'status_requ', // 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied 

    ];
    public function getprod()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getheader()
    {
        return $this->belongsTo(Bill_sale_header::class, 'bill_sale_header_id');
    }

}
