<?php

namespace App\Http\Requests;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sid'=>[
                'required',
                'integer',
                Rule::unique(Student::class,'sid')
            ],
            'name'=>[
                'required',
                'string',
            ],
            'birth_date'=>[
                'required',
            ],
            'course_id'=>[
                'integer',
                Rule::exists(Course::class,'id')
            ]
        ];
    }
}
