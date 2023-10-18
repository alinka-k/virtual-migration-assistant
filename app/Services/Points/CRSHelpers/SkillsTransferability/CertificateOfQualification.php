<?php

namespace App\Services\Points\CRSHelpers\SkillsTransferability;

class CertificateOfQualification implements SubsectionInterface
{
    const TABLE_HEADER = ['Certificate of Qualification', '+ CLB 5 or 6', '+ CLB 7 or higher'];

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function prepareSubsection(): array
    {
        return [
            'title' => $this->data['label'],
            'items' => $this->prepareItems(
                $this->data,
                self::TABLE_HEADER
            )
        ];
    }

    private function prepareItems(array $data, array $tableHeader): array
    {
        $preparedData = [
            $tableHeader,
        ];
        $preparedData[1][] = $data['label'];
        foreach ($data['points'] as  $point) {
            $preparedData[1][] = $point;
        }

        return $preparedData;
    }
}
