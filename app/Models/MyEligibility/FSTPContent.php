<?php

namespace App\Models\MyEligibility;

use App\Enums\ImmigrationScoreType;

class FSTPContent
{
    private string $mainText;
    private string $programDescription;
    private array $programRequirements;
    private array $sections;

    public function __construct(
        string $mainText,
        string $programDescription,
        array $programRequirements,
        array $sections
    ) {
        $this->mainText = $mainText;
        $this->programDescription = $programDescription;
        $this->programRequirements = $programRequirements;
        $this->sections = $sections;
    }

    public function getMainText(): string
    {
        return $this->mainText;
    }

    public function getProgramDescription(): string
    {
        return $this->programDescription;
    }

    public function getProgramRequirements(): array
    {
        return $this->programRequirements;
    }

    public function getSections(): array
    {
        return $this->sections;
    }

    public function getType(): string
    {
        return ImmigrationScoreType::FSTP;
    }
}
