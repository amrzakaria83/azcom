<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required',
            'name' => 'nullable|string|max:255',
            'link' => 'nullable',
            'classroom_id'=>'required|exists:classrooms,id',
            'subject_id'=>'nullable|exists:subjects,id',
        ];
    }
}
