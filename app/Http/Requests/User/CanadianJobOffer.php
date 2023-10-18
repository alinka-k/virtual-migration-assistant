<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property boolean $has_offer
 * @property string $occupation
 * @property string $province
 * @property string $district
 * @property string $in_bc_northeast_development_region
 * @property string $wage
 * @property string $duration
 * @property string $schedule_type
 * @property boolean $from_current_employer
 * @property string $has_lmia_approved
 * @property string $is_lmia_except
 * @property string $is_related_to_study
 * @property string $related_experience_years
 * @property string $bc_industry_training_authority_certificate
 * @property string $ab_related_edu_or_experience
 * @property string $ab_child_care_experience
 * @property boolean $sask_1a_driver_licence
 * @property boolean $ns_health_authority
 * @property string $mb_invitation_to_apply
 * @property string $atlantic_pilot_registered_employer
*/
class CanadianJobOffer extends FormRequest
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
            'has_offer' => 'boolean|nullable',
            'occupation' => 'string|nullable',
            'province' => 'string|nullable',
            'district' => 'string|nullable',
            'in_bc_northeast_development_region' => 'string|nullable',
            'wage' => 'string|nullable',
            'duration' => 'string|nullable',
            'schedule_type' => 'string|nullable',
            'from_current_employer' => 'boolean|nullable',
            'has_lmia_approved' => 'string|nullable',
            'is_lmia_except' => 'string|nullable',
            'is_related_to_study' => 'string|nullable',
            'related_experience_years' => 'string|nullable',
            'bc_industry_training_authority_certificate' => 'string|nullable',
            'ab_related_edu_or_experience' => 'string|nullable',
            'ab_child_care_experience' => 'string|nullable',
            'sask_1a_driver_licence' => 'boolean|nullable',
            'ns_health_authority' => 'boolean|nullable',
            'mb_invitation_to_apply' => 'string|nullable',
            'atlantic_pilot_registered_employer' => 'string|nullable',
        ];
    }
}
