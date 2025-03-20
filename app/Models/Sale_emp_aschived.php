<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale_emp_aschived extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'empsaled_id', 
        'prod_id',
        'sale_type_id',
        'percent',
        'note',
        'status',
    ];
    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'empsaled_id');
    }
    public function getprod()
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }
    public function getsaletype()
    {
        return $this->belongsTo(Sale_type::class, 'sale_type_id');
    }
}
