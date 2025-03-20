<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Employee;

class VisitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->status_visit == 0) {
            $status = 'single visit';
        } else if ($this->status_visit == 1) {
            $status = 'double visit';
        } else if ($this->status_visit == 2) {
            $status = 'triple visit';
        } 

        $empass = $this->visit_emp_ass;

        if ($this->visit_emp_ass != null) {
            $emp_list = Employee::select('id','name_en')->whereIn('id', json_decode($this->visit_emp_ass))->get();
        } else {
            $emp_list = [];
        }
        

        return [
            'id'=>$this->id,
            'emp_id'=>$this->emp_id,
            'type'=>$this->gettype->name_en,
            'center_id'=>$this->getcenter->id ?? '',
            'center'=>$this->getcenter->name_en ?? '',
            'contact_id'=>$this->getcenter->id ?? '',
            'contact'=>$this->getcontact->name_en ?? '',
            'status_id'=>$this->status_visit,
            'status'=>$status,
            'emp_list'=>$emp_list,
            'status_return'=>$this->status_return,
            'description'=>$this->description,
            'note'=>$this->note,
            'from_time'=>$this->from_time,
            'end_time'=>$this->end_time,
            'checkin_location'=>$this->checkin_location,
            'checkout_location'=>$this->checkout_location,
            'firstprodstep_id'=>$this->getfirstprod->id,
            'firstprodstep_name'=>$this->getfirstprod->name_en,
            'first_type'=>$this->first_type,
            'secondprodstep_id'=>$this->getsecondprod->id ?? 0,
            'secondprodstep_name'=>$this->getsecondprod->name_en ?? null,
            'second_type'=>$this->second_type ?? 0,
            'thirdprodstep_id'=>$this->getthirdprod->id ?? 0,
            'thirdprodstep_name'=>$this->getthirdprod->name_en ?? null,
            'third_type'=>$this->third_type ?? 0
            
        ];
    }
}
