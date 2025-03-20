<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan_visit extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'emphplan_id',
        'center_id',
        'contact_id',
        'typevist_id',
        'from_time', // dateTime
        'status_visit', //0 = single visit - 1 = double visit - 2 = triple visit
        'visit_emp_ass', // json
        'note',
        'status_planvisit_list', // 0 = listed contact - 1 = listed center - 2 = both - 3 = out list
        'status_return', // 0 = done - 1 = canceld - 3 = delayed - 4 = planned
        'status',
    ];
    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'emphplan_id');
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
    
}
