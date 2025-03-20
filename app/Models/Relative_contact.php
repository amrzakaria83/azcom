<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relative_contact extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'contact_id',
        'relative_status', // 0 = not_knowen - 1 = wife - 2 = husband - 3 = daughter  - 4 = son - 5 = father - 6 = mather - 7 = grandson - 8 = grandfather
        'name_en',
        'phone',
        'address',
        'birth_date',
        'gender', // 0 = male - 1 = female - 2 = other 
        'marital_status', // 0 = singel - 1 = married - 2 = divorced  - 3 = widow - 4 = married more 1
        'email',
        'website',
        'facebook',
        'socialmedia',
        'note',
        'description',
        'status',
    ];

    public function getcontact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
