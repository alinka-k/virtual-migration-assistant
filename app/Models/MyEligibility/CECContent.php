<?php

namespace App\Models\MyEligibility;

use App\Enums\ImmigrationScoreType;

class CECContent
{
    private string $mainText;
    private string $benefits;
    private array $programRequirements;
    private array $sections;
    private string $programDescription;

    public function __construct(
        string $mainText,
        string $benefits,
        string $programDescription,
        array $programRequirements,
        array $sections
    ) {
        $this->mainText = $mainText;
        $this->benefits = $benefits;
        $this->programRequirements = $programRequirements;
        $this->sections = $sections;
        $this->programDescription = $programDescription;
    }

    public function getMainText(): string
    {
        return $this->mainText;
    }

    public function getBenefits(): string
    {
        return $this->benefits;
    }

    public function getProgramRequirements(): array
    {
        return $this->programRequirements;
    }

    public function getSections(): array
    {
        return $this->sections;
    }

    public function getProgramDescription(): string
    {
        return $this->programDescription;
    }

    public function getType(): string
    {
        return ImmigrationScoreType::CEC;
    }
}
