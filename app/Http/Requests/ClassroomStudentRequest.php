<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomStudentRequest extends FormRequest
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
            'classroom_id'=>'required|exists:classrooms,id',
            'student_id'=>'nullable',
            'name' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
            'mother_num' => 'nullable',
            'father_num' => 'nullable',
            'address' => 'nullable',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable',
            'user_id'=>'nullable'
        ];
    }
}
