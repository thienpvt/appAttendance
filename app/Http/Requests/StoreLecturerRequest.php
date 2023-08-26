<?php

    namespace App\Http\Requests;

    use App\Models\User;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class StoreLecturerRequest extends FormRequest
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
                'name' => [
                    'required',
                    'string',
                ],
                'email' => [
                    'required',
                    'email',
                    Rule::unique(User::class, 'email')
                ],
                'password' => [
                    'required',
                    'string',
                ],
                'birth_date' => [
                    'required',
                    'date',
                ],
                'avatar' => [
                    'nullable',
                    'file',
                ],
            ];
        }
    }
