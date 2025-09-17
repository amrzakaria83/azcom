<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\App;

class Employee extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasRoles, HasFactory, Notifiable, InteractsWithMedia, SoftDeletes;

    protected $guard = "admin";

    protected $fillable = [
        'name_en',
        'job_title',
        'level_id',
        'national_id',
        'birth_date',
        'work_date',
        'phone',
        'phone2',
        'phone3',
        'address1',
        'bank_name',
        'social_insurance_no',
        'medical_insurance_no',
        'salary',
        'department',
        'note',
        'type', // 0 = admin
        'gender',
        'method_for_payment', // 0 = cash, 1 = bank_transefer , 2 = instapay
        'acc_bank_no',
        'role_id',
        'email',
        'password',
        'is_active', // 0 = not active, 1 = active, 2 = suspended , 3 = terminated
        'token',
        'fc_token',
    ]; 

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('profile')
        ->singleFile();

        $this->addMediaConversion('thumb')
        ->keepOriginalImageFormat()
        ->crop('crop-center', 150, 150);

        $this->addMediaCollection('attach')
        ->singleFile();
    }

    public function children()
    {
        return $this->belongsToMany(
            Employee::class,
            'hierarchy_emps',
            'above_hierarchy',
            'emphier_id'
        );
    }

    // Define the relationship for parent
    public function parent()
    {
        return $this->belongsToMany(
            Employee::class,
            'hierarchy_emps',
            'emphier_id',
            'above_hierarchy'
        );
    }

    public function classrooms () {
        return $this->hasMany(ClassroomTeacher::class, 'employee_id');
    } 

    public function msgcount () {
        return $this->hasMany(Message::class, 'sender_id');
    }
    // public function registerMediaCollections(Media $media = null): void
    // {
    //     $this->addMediaCollection('attachment')
    //     ->singleFile();

    // }

}
