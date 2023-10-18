<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CanadianJobOffer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'has_offer' => boolOrNull($this->has_offer),
            'occupation' => $this->occupation,
            'province' => $this->province,
            'district' => $this->district,
            'in_bc_northeast_development_region' => $this->in_bc_northeast_development_region,
            'wage' => $this->wage,
            'duration' => $this->duration,
            'schedule_type' => $this->schedule_type,
            'from_current_employer' => boolOrNull($this->from_current_employer),
            'has_lmia_approved' => $this->has_lmia_approved,
            'is_lmia_except' => $this->is_lmia_except,
            'is_related_to_study' => $this->is_related_to_study,
            'related_experience_years' => $this->related_experience_years,
            'bc_industry_training_authority_certificate' => $this->bc_industry_training_authority_certificate,
            'ab_related_edu_or_experience' => $this->ab_related_edu_or_experience,
            'ab_child_care_experience' => $this->ab_child_care_experience,
            'sask_1a_driver_licence' => boolOrNull($this->sask_1a_driver_licence),
            'ns_health_authority' => boolOrNull($this->ns_health_authority),
            'mb_invitation_to_apply' => $this->mb_invitation_to_apply,
            'atlantic_pilot_registered_employer' => $this->atlantic_pilot_registered_employer,
        ];
    }
}
