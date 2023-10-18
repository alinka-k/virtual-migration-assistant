<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property boolean $has_work_experience_10_yr
 * @property boolean $qualification_certificate
 * @property boolean $no_more_works
 * @property array $history
 */
class WorkHistoryRequest extends FormRequest
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
        return [
            'has_work_experience_10_yr' => 'boolean|nullable',
            'no_more_works' => 'boolean|nullable',
            'qualification_certificate' => 'boolean|nullable',
            'history.*.occupation' => 'string|nullable',
            'history.*.noc' => 'string|nullable',
            'history.*.duration' => 'string|nullable',
            'history.*.when' => 'string|nullable',
            'history.*.schedule_type' => 'string|nullable',
            'history.*.work_type' => 'string|nullable',
            'history.*.location' => 'string|nullable',
            'history.*.province' => 'string|nullable',
            'history.*.related_to_study_field' => 'string|nullable',
            'history.*.work_permit' => 'string|nullable',
            'history.*.full_ownership' => 'boolean|nullable',
            'history.*.start_date' => 'string|nullable',
        ];
    }
}
