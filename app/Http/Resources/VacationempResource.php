<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacationempResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->vacationrequesttype == 0) {
            $type = 'General Leave';
        } else if ($this->vacationrequesttype == 1) {
            $type = 'Sick Leave';
        } else {
            $type = 'Maternity Leave (no deduction)';
        }

        if ($this->vacationrequest == 0) {
            $salary = 'without salary';
        } else if ($this->vacationrequest == 1) {
            $salary = '50% salary';
        } else {
            $salary = 'full salary';
        }

        if ($this->salary == 0) {
            $salary_manager = 'without salary';
        } else if ($this->salary == 1) {
            $salary_manager = '50% salary';
        } else {
            $salary_manager = 'full salary';
        }

        if ($this->statusmangeraprove == 0) {
            $status = 'waitting';
        } else if ($this->statusmangeraprove == 1) {
            $status = 'approved';
        } else if ($this->statusmangeraprove == 2) {
            $status = 'rejected';
        } else {
            $status = 'delayed';
        }

        return [
            'id'=>$this->id,
            'from_date'=>$this->vactionfrom,
            'to_date'=>$this->vactionto,
            'from_date_manager'=>$this->vactionfrommanger,
            'to_date_manager'=>$this->vactiontomanger,
            'type'=>$type,
            'status'=>$status,
            'salary'=>$salary,
            'salary_manager'=>$salary_manager,
            'note'=>$this->noterequest,
            'note_manger'=>$this->notemanger,
        ];
    }
}
