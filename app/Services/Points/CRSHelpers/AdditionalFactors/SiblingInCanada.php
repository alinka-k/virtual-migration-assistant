<?php

namespace App\Services\Points\CRSHelpers\AdditionalFactors;

use App\Services\Points\CRSHelpers\SkillsTransferability\SubsectionInterface;

class SiblingInCanada implements SubsectionInterface
{
    const TABLE_HEADER = ['Canadian study experience', 'Points'];

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function prepareSubsection(): array
    {
        return [
            'items' => [
                self::TABLE_HEADER,
                [
                    $this->data['label'],
                    $this->data['points'],
                ],
            ]
        ];
    }
}
