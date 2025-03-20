<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment_visit extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add 
        'visit_id',
        'title',
        'comment',
        'status',
    ];
    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    } 
    public function getprod()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
