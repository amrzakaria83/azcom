<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refund_sale extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'cust_id',
        'prod_id', // products
        'bill_sale_header_id',//bill_sale_headers
        'approv_quantity_ref',
        'approv_sellpriceproduct_ref',
        'approv_percent_ref',
        'status_requ_ref', // 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = done
        'refund_causes_id',//refund_causes
        'parent_id',
        'value',
        'note',
        'status',
    ];
    public function getprod()
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }
    public function getcust()
    {
        return $this->belongsTo(Cut_sale::class, 'cust_id');
    }
    public function getheader()
    {
        return $this->belongsTo(Bill_sale_header::class, 'bill_sale_header_id');
    }
    public function getrefcause()
    {
        return $this->belongsTo(Refund_cause::class, 'refund_causes_id');
    }
}
