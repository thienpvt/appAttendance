<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>[
                'required',
                'integer',
                Rule::unique(Student::class)->ignore($this->student)
            ],
            'sid'=>[
                'required',
                'integer',
                Rule::unique(Student::class)->ignore($this->student)
            ],
            'name'=>[
                'required',
                'string',
                Rule::unique(Student::class)->ignore($this->student)
            ],
            'birth_date'=>[
                'required',
                'date',
            ],
        ];
    }
}
