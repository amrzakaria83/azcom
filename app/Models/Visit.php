<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add 
        'empvisit_id', 
        'typevist_id',
        'center_id',
        'contact_id',
        'status_visit',// 0 = single visit - 1 = double visit - 2 = triple visit
        'firstprodstep_id',
        'first_type', //0 = details - 1 = reminder
        'secondprodstep_id',
        'second_type',//0 = details - 1 = reminder
        'thirdprodstep_id',
        'third_type',//0 = details - 1 = reminder
        // 'product_id', // json
        'visit_emp_ass', // json
        'note',
        'status_return', // 0 = planned - 1 = randum
        'status_visit_list', // 0 = listed contact - 1 = listed center - 2 = both - 3 = out list - 4 = cancelled
        'description',
        'checkin_location',
        'from_time',
        'checkout_location',
        'end_time',
        'status',
    ];
    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'empvisit_id');
    } 
    public function gettype()
    {
        return $this->belongsTo(Type_visit::class, 'typevist_id');
    }
    public function getcontact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
    public function getcenter()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }
    public function getprod()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getfirstprod()
    {
        return $this->belongsTo(Product::class, 'firstprodstep_id');
    }
    public function getsecondprod()
    {
        return $this->belongsTo(Product::class, 'secondprodstep_id');
    }
    public function getthirdprod()
    {
        return $this->belongsTo(Product::class, 'thirdprodstep_id');
    }
}
