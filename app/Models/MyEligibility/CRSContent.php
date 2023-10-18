<?php

namespace App\Models\MyEligibility;

use App\Enums\ImmigrationScoreType;

class CRSContent extends FSWPPage
{
    private string $scoreBubble;
    private string $breakdown;
    private string $benefits;

    public function __construct(
        $currentScore,
        $scoreBubble,
        $sections,
        $programDescription,
        $programRequirements,
        $breakdown,
        $benefits
    ) {
        $this->scoreBubble = $scoreBubble;
        $this->breakdown = $breakdown;
        $this->benefits = $benefits;

        parent::__construct(
            $sections,
            $programDescription,
            $programRequirements,
            $currentScore
        );
    }

    public function getScoreBubble(): string
    {
        return $this->scoreBubble;
    }

    public function getBreakdown(): string
    {
        return $this->breakdown;
    }

    public function getBenefits(): string
    {
        return $this->benefits;
    }

    public function getType(): string
    {
        return ImmigrationScoreType::CRS;
    }
}
