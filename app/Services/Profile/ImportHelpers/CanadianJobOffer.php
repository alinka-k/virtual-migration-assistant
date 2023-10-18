<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use Arr;

class CanadianJobOffer implements ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        $jobOfferData = self::prepareDataToFill($data);
        if (empty($jobOfferData)) {
            return true;
        }
        if ($user->jobOffer) {
            $user->jobOffer->delete();
        }
        $model = $user->jobOffer()->firstOrNew();

        $model->fill($jobOfferData);
        return $model->save();
    }

    public static function prepareDataToFill($data): array
    {
        $prepareJobOfferData = Arr::get($data, 'canadian_job_offer.job_offer', []) ?? [];

        if (empty($prepareJobOfferData)) {
            return [];
        }

        $prepareJobOfferData['has_offer'] = Arr::get($data, 'canadian_job_offer.has_offer');
        return $prepareJobOfferData;
    }
}
