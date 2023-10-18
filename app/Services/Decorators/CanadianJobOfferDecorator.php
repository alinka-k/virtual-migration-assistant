<?php

namespace App\Services\Decorators;

use App\Models\User\UserCanadianJobOffer;
use App\Specifications\Profile\JobOfferSpecification;

final class CanadianJobOfferDecorator
{
    private UserCanadianJobOffer $offer;
    private JobOfferSpecification $specification;

    public function __construct(UserCanadianJobOffer $offer)
    {
        $this->offer = $offer;
        $this->specification = new JobOfferSpecification($this->offer);
    }

    public function decorate(): UserCanadianJobOffer
    {
        if (!$this->specification->isProvinceBritishColumbia()) {
            $this->offer->district = null;
            $this->offer->in_bc_northeast_development_region = null;
            $this->offer->wage = null;
            $this->offer->related_experience_years = null;
            $this->offer->bc_industry_training_authority_certificate = null;
        }

        if (!$this->specification->isSatisfiedCurrentlyEmployed()) {
            $this->offer->from_current_employer = null;
        }

        if (!$this->specification->hasLmiaApproved()) {
            $this->offer->is_lmia_except = null;
        }
        if (!$this->specification->isProvinceSaskatchewan()) {
            $this->offer->is_related_to_study = null;
            $this->offer->sask_1a_driver_licence = null;
        }
        if (!$this->specification->isProvinceAlberta()) {
            $this->offer->ab_related_edu_or_experience = null;
            $this->offer->ab_child_care_experience = null;
        }
        if (!$this->specification->isProvinceNovaScotia()) {
            $this->offer->ns_health_authority = null;
        }
        if (!$this->specification->isProvinceManitoba()) {
            $this->offer->mb_invitation_to_apply = null;
        }
        if (!$this->specification->isSatisfiedAtlantic()) {
            $this->offer->atlantic_pilot_registered_employer = null;
        }

        return $this->offer;
    }
}
