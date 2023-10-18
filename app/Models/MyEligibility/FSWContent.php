<?php

namespace App\Models\MyEligibility;

use App\Enums\ImmigrationScoreType;

class FSWContent extends FSWPPage
{
    public const MAX_POINTS_FOR_FSW = 67;

    private string $mainText;

    public function __construct(
        string $mainText,
        array $sections,
        string $programDescription,
        array $programRequirements,
        int $currentScore
    ) {
        $this->mainText = $mainText;
        parent::__construct(
            $sections,
            $programDescription,
            $programRequirements,
            $currentScore
        );
    }

    public function getMainText(): string
    {
        return $this->mainText;
    }

    public function getType(): string
    {
        return ImmigrationScoreType::FSW;
    }

    public function getMaxScore(): int
    {
        return self::MAX_POINTS_FOR_FSW;
    }
}
