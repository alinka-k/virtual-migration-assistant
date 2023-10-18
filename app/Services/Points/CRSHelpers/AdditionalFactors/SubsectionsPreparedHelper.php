<?php

namespace App\Services\Points\CRSHelpers\AdditionalFactors;

use Arr;

abstract class SubsectionsPreparedHelper
{
    const TABLE_HEADER = [];

    protected array $factors;

    public function __construct(array $data)
    {
        $this->factors = Arr::get($data, 'factors', []);
    }

    public function prepareSubsection(): array
    {
        return [
            'items' => $this->prepareItems(
                $this->factors,
                $this::TABLE_HEADER
            )
        ];
    }

    private function prepareItems(array $factors, array $tableHeader): array
    {
        $preparedData = [
            $tableHeader,
        ];

        foreach ($factors as $key => $factor) {
            $preparedData[$key + 1][] = $factor['label'];
            if (is_array($factor['points'])) {
                foreach ($factor['points'] as $point) {
                    $preparedData[$key + 1][] = $point;
                }
            } else {
                $preparedData[$key + 1][] = $factor['points'];
            }
        }

        return $preparedData;
    }
}
