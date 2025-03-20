<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emp_sale extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'prod_id',
        'empsaled_id',
        'sale_type_id',
        'percent', //>decimal('percent', 10, 3)
        'quantity', //>decimal('quantity', 10, 3)
        'total_quantity', // >decimal('total_quantity', 10, 3)
        'unit_sellprice', // >decimal('unit_sellprice', 10, 3)
        'value_at', // date
        'note',
        'status',
    ];
    public function getprod()
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }
    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'empsaled_id');
    }
    public function getsaletype()
    {
        return $this->belongsTo(Sale_type::class, 'sale_type_id');
    }
}
