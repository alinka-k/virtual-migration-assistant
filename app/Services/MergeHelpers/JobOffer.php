<?php

namespace App\Services\MergeHelpers;

use Arr;

class JobOffer extends BaseHelper
{
    public function handle()
    {
        return [
            'has_offer' => (bool)$this->getValue('occupation'),
            'job_offer' => [
                'occupation' => $this->getValue('occupation'),
                'province' => $this->getValue('province'),
                'district' => Arr::get($this->virtualProfile->user, 'jobOffer.district'),
                'in_bc_northeast_development_region' => Arr::get($this->virtualProfile->user, 'jobOffer.in_bc_northeast_development_region'),
                'wage' => Arr::get($this->virtualProfile->user, 'jobOffer.wage'),
                'duration' => $this->getValue('duration'),
                'schedule_type' => Arr::get($this->virtualProfile->user, 'jobOffer.schedule_type'),
                'from_current_employer' => Arr::get($this->virtualProfile->user, 'jobOffer.from_current_employer'),
                'has_lmia_approved' => Arr::get($this->virtualProfile->user, 'jobOffer.has_lmia_approved'),
                'is_lmia_except' => Arr::get($this->virtualProfile->user, 'jobOffer.is_lmia_except'),
                'is_related_to_study' => Arr::get($this->virtualProfile->user, 'jobOffer.is_related_to_study'),
                'related_experience_years' => Arr::get($this->virtualProfile->user, 'jobOffer.related_experience_years'),
                'bc_industry_training_authority_certificate' => Arr::get($this->virtualProfile->user, 'jobOffer.bc_industry_training_authority_certificate'),
                'ab_related_edu_or_experience' => Arr::get($this->virtualProfile->user, 'jobOffer.ab_related_edu_or_experience'),
                'ab_child_care_experience' => Arr::get($this->virtualProfile->user, 'jobOffer.ab_child_care_experience'),
                'sask_1a_driver_licence' => (bool)Arr::get($this->virtualProfile->user, 'jobOffer.sask_1a_driver_licence'),
                'ns_health_authority' => (bool)Arr::get($this->virtualProfile->user, 'jobOffer.ns_health_authority'),
                'mb_invitation_to_apply' => Arr::get($this->virtualProfile->user, 'jobOffer.mb_invitation_to_apply'),
                'atlantic_pilot_registered_employer' => Arr::get($this->virtualProfile->user, 'jobOffer.atlantic_pilot_registered_employer'),
            ],
        ];
    }

    protected function getValue($field)
    {
        if (Arr::get($this->virtualProfile, 'jobOffer.' . $field)) {
            return Arr::get($this->virtualProfile, 'jobOffer.' . $field);
        }
        return Arr::get($this->virtualProfile->user, 'jobOffer.' . $field);
    }
}
