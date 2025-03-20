<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Expense_request extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'emp_id_dirctor', 
        'type_id', 
        'value',
        'note',
        'status',
        'notepayment',
        'statusresponse', // "0 = waitting - 1 = approved - 2 = rejected - 3 = delayed 
    ];
    
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('attach')
        ->singleFile();

        $this->addMediaConversion('thumb')
        ->keepOriginalImageFormat()
        ->width(500);
    }

    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function gettype()
    {
        return $this->belongsTo(Type_expense::class, 'type_id');
    }
    public function getempdirector()
    {
        return $this->belongsTo(Employee::class, 'emp_id_dirctor');
    }
}
