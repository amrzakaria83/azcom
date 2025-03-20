<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class List_contac extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'emplist_id', 
        'name_en',
        'contact_id', 
        'center_id',
        'parentlist_id',
        'taregetvisit', 
        'sales_funel_id',
        'note',
        'status',
    ];

    // protected $fillable = [
    //     'emp_id', // emp_add
    //     'name_en',
    //     'emplist_id', 
    //     'contact_id', //json 
    //     'center_id', //json 
    //     'description',
    //     'note',
    //     'status',
    // ];

    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'emplist_id');
    }
    public function getcontact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
    public function getfunnel()
    {
        return $this->belongsTo(Sales_funel::class, 'sales_funel_id');
    }
}
