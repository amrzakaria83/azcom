<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event_att extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'empatt_id',
        'event_id',
        'checkin_location',
        'from_time',
        'checkout_location',
        'end_time',
        'note',
        'status',
    ];

    public function getevent()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function getempatt()
    {
        return $this->belongsTo(Employee::class, 'empatt_id');
    }
}
