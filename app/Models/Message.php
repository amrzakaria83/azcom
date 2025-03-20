<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function teacher(){
        return $this->belongsTo(Employee::class, 'sender_id');
        return $this->belongsTo(Employee::class, 'receiver_id');
    }

    public function receiver(){
        if ($this->receiver_type == 'student') {
            return $this->belongsTo(Student::class, 'receiver_id');
        } else {
            return $this->belongsTo(Employee::class, 'receiver_id');
        }
    }

    public function sender(){
        if ($this->sender_type == 'student') {
            return $this->belongsTo(Student::class, 'sender_id');
        } else {
            return $this->belongsTo(Employee::class, 'sender_id');
        }
    }

    public function sendertypestudent(){
        if ($this->sender_type == 'student') {
            return $this->belongsTo(Student::class, 'sender_id');
        } else {
            return false;
        }
    }
    
    // public function scopesendertype(){
    //     return $query->where('category', 1);
    // }

    public static function testt () {
        if ($this->sender_type == 'teacher') {
            return 'teacher';
        } else {
            return 'student';
        }

    }

    // if ($this->receiver_type == 'teacher') {
    //     $this->belongsTo(Employee::class, 'sender_id');
    // } else {
    //     $this->belongsTo(Student::class, 'sender_id');
    // }
    // public function sections () {
    //     $this->hasMany(Section::class, 'section_id');
    // }
}
