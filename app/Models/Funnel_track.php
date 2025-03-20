<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funnel_track extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'list_id',
        'status_funnel_befor',
        'status_funnel_after',
        'update_time',
        'note',
        'status',
    ];
    public function getlist()
    {
        return $this->belongsTo(List_contac::class, 'list_id');
    }
    public function getfunbefore()
    {
        return $this->belongsTo(Sales_funel::class, 'status_funnel_befor');
    }
    public function getfunafter()
    {
        return $this->belongsTo(Sales_funel::class, 'status_funnel_after');
    }

}
