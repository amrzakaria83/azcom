<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact_rate extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add 
        'contact_id',
        'rate_id',
        'value',
        'status',
    ];
    public function getrate()
    {
        return $this->belongsTo(Rating::class, 'rate_id');
    }
    public function getcontact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

}
