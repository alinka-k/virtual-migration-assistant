<?php

namespace App\Models\MyEligibility;

class FSWPPage
{
    private array $sections;
    private string $programDescription;
    private array $programRequirements;
    private int $currentScore;

    public function __construct(
        array $sections,
        string $programDescription,
        array $programRequirements,
        int $currentScore
    ) {
        $this->sections = $sections;
        $this->programDescription = $programDescription;
        $this->programRequirements = $programRequirements;
        $this->currentScore = $currentScore;
    }

    public function getSections(): array
    {
        return $this->sections;
    }

    public function getProgramDescription(): string
    {
        return $this->programDescription;
    }

    public function getProgramRequirements(): array
    {
        return $this->programRequirements;
    }

    public function getCurrentScore(): int
    {
        return $this->currentScore;
    }
}
