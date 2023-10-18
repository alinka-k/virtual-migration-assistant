<?php

namespace App\Services\Points\CRSHelpers\SkillsTransferability;

use Arr;

abstract class SubsectionsPreparedHelper
{
    const SUBSECTIONS = [];

    protected array $factors;

    public function __construct(array $data)
    {
        $this->factors = Arr::get($data, 'factors', []);
    }

    public function prepareSubsection(): array
    {
        $preparedData = [];
        foreach ($this->factors as $factor) {
            if (Arr::has($this::SUBSECTIONS, $factor['label'])) {
                $preparedData['title'] = $factor['label'];
                $preparedData['items'] = $this::prepareItems(
                    $factor['factors'],
                    $this::SUBSECTIONS[$factor['label']]
                );
            }
        }

        return $preparedData;
    }

    private function prepareItems(array $factors, array $tableHeader): array
    {
        $preparedData = [
            $tableHeader,
        ];

        foreach ($factors as $key => $factor) {
            $preparedData[$key + 1][] = $factor['label'];
            foreach ($factor['points'] as $point) {
                $preparedData[$key + 1][] = $point;
            }
        }

        return $preparedData;
    }
}
