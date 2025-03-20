<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Vacationemp extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $fillable = [
        'emp_id', // emp_add
        'emp_vacation', 
        'vactionfrom',
        'vactionto',
        'vacationrequesttype', // 0 =  general leave - 1 = sick leave - 2 = Maternity Leave (no deduction )
        'vacationrequest', // 0 = without salary - 1 = 50%salary - 2 = fullsalary 
        'typevacation', // 0 = without salary - 1 = 50%salary - 2 = fullsalary 
        'statusmangeraprove', // 0 = waitting - 1 = approved - 2 = rejected - 3 = delayed 
        'status',
        'noterequest',
        'notemanger',
        'vactionfrommanger',
        'vactiontomanger',
    ];

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('attach')
        ->singleFile();
    }

    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'emp_vacation');
    }
}
