<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserSpouseRequest extends FormRequest
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
            'age' => 'string|nullable',
            'education_level' => 'string',
            'english' => 'string',
            'french' => 'string',
            'has_foreign_work' => 'boolean',
            'foreign_exp_years' => 'string',
            'has_canadian_work' => 'boolean',
            'canadian_exp_years' => 'string',
        ];
    }
}
