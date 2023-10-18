<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserFuturePlansRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
            'is_graduation' => 'boolean|nullable',
            'program_id' => 'exists:future_plan_programs,id|nullable',
            'graduation_date' => 'date|nullable',
            'is_user_program' => 'boolean|nullable',
            'user_program' => 'string|nullable',
            'is_currently_employed' => 'boolean|nullable',
            'is_interested_in_study' => 'boolean|nullable',
            'desired_study' => 'string|nullable',
            'type_program' => 'nullable|in:M.A,B.A,PHD',
            'investment' => 'numeric|nullable',
        ];
    }

    public function messages()
    {
        return [
            'type_program.in'  => 'Type program should be one of M.A,B.A,PHD.',
            'program_id.exists'  => 'Please select program.',
        ];
    }

    public function validationData()
    {
        $data = parent::validationData();
        $data['program_id'] = empty($data['program_id']) ? null : $data['program_id'];
        return $data;
    }
}
