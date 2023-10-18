<?php

namespace App\Services\Points\CRSHelpers\AdditionalFactors;

use App\Services\Points\CRSHelpers\SkillsTransferability\SubsectionInterface;

class ProvincialNominationCertificate implements SubsectionInterface
{
    const TABLE_HEADER = ['Provincial Nominee Program (PNP) nomination certificate', 'Points'];

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function prepareSubsection(): array
    {
        return [
            'title' => 'Skill Transferability Combinations',
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
