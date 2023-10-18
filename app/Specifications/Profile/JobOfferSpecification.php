<?php

namespace App\Specifications\Profile;

use App\Models\User\UserCanadianJobOffer;

final class JobOfferSpecification
{
    private UserCanadianJobOffer $offer;

    public function __construct(UserCanadianJobOffer $offer)
    {
        $this->offer = $offer;
    }

    public function isProvinceBritishColumbia(): bool
    {
        return $this->offer->province === 'British Columbia';
    }

    public function isProvinceAlberta(): bool
    {
        return $this->offer->province === 'Alberta';
    }

    public function isProvinceSaskatchewan(): bool
    {
        return $this->offer->province === 'Saskatchewan';
    }

    public function isProvinceNovaScotia(): bool
    {
        return $this->offer->province === 'Nova Scotia';
    }

    public function isProvinceManitoba(): bool
    {
        return $this->offer->province === 'Manitoba';
    }

    public function hasLmiaApproved(): bool
    {
        return $this->offer->has_lmia_approved === 'No';
    }

    public function isSatisfiedAtlantic(): bool
    {
        $batch = ['New Brunswick', 'Newfoundland and Labrador', 'Nova Scotia', 'Prince Edward Island'];
        return in_array($this->offer->province, $batch);
    }

    public function isSatisfiedCurrentlyEmployed(): bool
    {
        $satisfied = false;

        foreach (\Arr::get($this->offer, 'user.work.histories', []) as $history) {
            $spec = new WorkHistorySpecification($history);
            if ($spec->isCanada() && $spec->isCurrentlyWorking()) {
                $satisfied = true;
            }
        }

        return $satisfied;
    }
}
