<?php

namespace App\Services\MergeHelpers;

use App\Models\User\UserLanguage;
use App\Models\VirtualProfile\VirtualLanguage;
use App\Services\CLBConverter;

class Language extends BaseHelper
{
    public function handle()
    {
        $returnData = [];
        $virtualLanguages = $this->virtualProfile->languages;

        foreach ($virtualLanguages as $language) {
            /** @var VirtualLanguage $language */
            if ($this->hasChanges($language)) {
                $model = $this->getConvertedData($language);
            } else {
                $model = $this->getDefaultLanguageByType($language->language_type);
            }

            if ($model) {
                $returnData[$language->language_type] = (new CLBConverter($model))->convertByTypes();
            }
        }
        return $returnData;
    }

    protected function hasChanges(VirtualLanguage $language)
    {
        $data = [
            $language->clb,
            $language->writing,
            $language->reading,
            $language->speaking,
            $language->listening,
        ];

        $res = array_filter($data, function ($item) {
            return !empty($item) && $item > 0;
        });

        return count($res) > 0;
    }

    protected function getConvertedData(VirtualLanguage $model): UserLanguage
    {
        $userLanguage = new UserLanguage();
        $userLanguage->fillRegardingTest($model->getAttributes());
        return $userLanguage;
    }

    protected function getDefaultLanguageByType($type)
    {
        return $this->virtualProfile->user->languages->where('language_type', $type)->pop();
    }
}
