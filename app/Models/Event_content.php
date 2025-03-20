<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event_content extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'event_id',
        'from_time',
        'to_time',
        'type_event_content', // 0 = schedule - 1 = logistics - 2 = point discussion - 3 = recommended activities - 4 = other
        'name_en',
        'note',
        'status',
    ];

    public function getevent()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}