<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emp_bill_sale extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'sale_id',//bill_sale_details
        'empsaled_id',
        'sale_type_id',
        'percent', //>decimal('percent', 10, 3)
        'value', //>decimal('percent', 10, 3)
        'note',
        'status',
    ];
    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'empsaled_id');
    }
    public function getsaletype()
    {
        return $this->belongsTo(Sale_type::class, 'sale_type_id');
    }
    public function getsaledetails()
    {
        return $this->belongsTo(Bill_sale_detail::class, 'sale_id');
    }
}
