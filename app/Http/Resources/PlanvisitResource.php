<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Employee;

class PlanvisitResource extends JsonResource
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

        $empass = json_decode($this->visit_emp_ass);
        // dd($empass);
        if (is_array($empass)) {
            $emp_list = Employee::select('id','name_en')->whereIn('id', $empass)->get();
        } else {
            $emp_list = [];
        }
        

        return [
            'id'=>$this->id,
            'center_id'=>$this->getcenter->id ?? '',
            'center'=>$this->getcenter->name_en ?? '',
            'contact_id'=>$this->getcontact->id ?? '',
            'contact'=>$this->getcontact->name_en ?? '',
            'type_id'=>$this->gettype->id,
            'type'=>$this->gettype->name_en,
            'date'=>$this->from_time,
            'status_id'=>$this->status_visit,
            'status'=>$status,
            'note'=>$this->note,
            'emp_list'=>$emp_list,
        ];
    }
}
