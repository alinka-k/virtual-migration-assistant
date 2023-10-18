<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CanadianJobOffer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'has_offer' => (bool)Arr::get($this, 'has_offer'),
            'job_offer' => [
                'occupation' => Arr::get($this, 'occupation'),
                'province' => Arr::get($this, 'province'),
                'district' => Arr::get($this, 'district'),
                'in_bc_northeast_development_region' => Arr::get($this, 'in_bc_northeast_development_region'),
                'wage' => Arr::get($this, 'wage'),
                'duration' => Arr::get($this, 'duration'),
                'schedule_type' => Arr::get($this, 'schedule_type'),
                'from_current_employer' => Arr::get($this, 'from_current_employer'),
                'has_lmia_approved' => Arr::get($this, 'has_lmia_approved'),
                'is_lmia_except' => Arr::get($this, 'is_lmia_except'),
                'is_related_to_study' => Arr::get($this, 'is_related_to_study'),
                'related_experience_years' => Arr::get($this, 'related_experience_years'),
                'bc_industry_training_authority_certificate' => Arr::get($this, 'bc_industry_training_authority_certificate'),
                'ab_related_edu_or_experience' => Arr::get($this, 'ab_related_edu_or_experience'),
                'ab_child_care_experience' => Arr::get($this, 'ab_child_care_experience'),
                'sask_1a_driver_licence' => (bool)Arr::get($this, 'sask_1a_driver_licence'),
                'ns_health_authority' => (bool)Arr::get($this, 'ns_health_authority'),
                'mb_invitation_to_apply' => Arr::get($this, 'mb_invitation_to_apply'),
                'atlantic_pilot_registered_employer' => Arr::get($this, 'atlantic_pilot_registered_employer'),
            ],
        ];
    }
}
