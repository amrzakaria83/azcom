<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hierarchy_emp extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emp_id', // emp_add
        'emphier_id',
        'type_hierarchy', // 0 = main - 1 = middle - 2 = end hierarchy
        'parent_id',
        'above_hierarchy', 
        'bellow_hierarchy', //json emp_id 
        'status_area', //0 = area active - 1 = area notactive
        'area', //json area_id
        'status_prod', //0 = prod active - 1 = prod notactive
        'prod', //json prod_id
        'status',
    ];
    public function getemp()
    {
        return $this->belongsTo(Employee::class, 'emphier_id');
    }
    public function getarea()
    {
        $areaIds = json_decode($this->area);
        $azarea = Area::whereIn('id', $areaIds)->get();
        if (!empty($azarea)) {
            foreach($azarea as $nutriarea){

                return $this->belongsTo(area::class, $nutriarea);
            }

            }

    }
    public function getaboveemp()
    {
        return $this->belongsTo(Employee::class, 'above_hierarchy');
    }
    public function getareaname()
    {
        $areaIds = json_decode($this->area, true);
        if (empty($areaIds)) {
            return null;
        }
        
        $areas = Area::whereIn('id', $areaIds)->get();
        $names = $areas->pluck('name_en')->toArray();
        
        return implode(', ', $names);
    }
    public function getprodname()
    {
        $prodIds = json_decode($this->prod, true);
        if (empty($prodIds)) {
            return null;
        }

        $products = Product::whereIn('id', $prodIds)->get();
        $names = $products->pluck('name_en')->toArray();

        return implode(', ', $names);
    }
}
