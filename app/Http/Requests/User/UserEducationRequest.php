<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property boolean $highschool_completed
 * @property boolean $has_post_secondary_education
 * @property boolean $no_more_diplomas
 */
class UserEducationRequest extends FormRequest
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
            'highschool_completed' => 'boolean|nullable',
            'has_post_secondary_education' => 'boolean|nullable',
            'no_more_diplomas' => 'boolean|nullable',
        ];
    }
}
