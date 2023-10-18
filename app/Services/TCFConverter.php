<?php

namespace App\Services;

use App\Models\User\UserLanguage;

class TCFConverter extends LanguageTestConverter implements LanguageConverterInterface
{
    private const TEST = 'TCF';
    private array $reading;
    private array $writing;
    private array $listening;
    private array $speaking;

    /**
     * @var UserLanguage
     */
    private UserLanguage $userLanguage;

    public function __construct(UserLanguage $userLanguage)
    {
        $this->userLanguage = $userLanguage;

        $this->reading = [
            0 => range(0, 341),
            4 => range(342, 374),
            5 => range(375, 405),
            6 => range(406, 452),
            7 => range(453, 498),
            8 => range(499, 523),
            9 => range(524, 548),
            10 => range(549, 699),
        ];

        $this->writing = [
            0 => range(0, 3),
            4 => range(4, 5),
            5 => range(6, 6),
            6 => range(7, 9),
            7 => range(10, 11),
            8 => range(12, 13),
            9 => range(14, 15),
            10 => range(16, 20),
        ];

        $this->listening = [
            0 => range(0, 330),
            4 => range(331, 368),
            5 => range(369, 397),
            6 => range(398, 457),
            7 => range(458, 502),
            8 => range(503, 522),
            9 => range(523, 548),
            10 => range(549, 699),
        ];

        $this->speaking = [
            0 => range(0, 3),
            4 => range(4, 5),
            5 => range(6, 6),
            6 => range(7, 9),
            7 => range(10, 11),
            8 => range(12, 13),
            9 => range(14, 15),
            10 => range(16, 20),
        ];
    }

    public function supports($languageTest): bool
    {
        return $languageTest === self::TEST;
    }

    public function convertToCLB(): float
    {
        $convertedGrades = [
            $this->getCLB($this->reading, $this->userLanguage->reading_test),
            $this->getCLB($this->writing, $this->userLanguage->writing_test),
            $this->getCLB($this->speaking, $this->userLanguage->speaking_test),
            $this->getCLB($this->listening, $this->userLanguage->listening_test)
        ];

        return round(collect($convertedGrades)->avg());
    }

    public function convertByTypes(): array
    {
        return [
            'reading' => $this->getCLB($this->reading, $this->userLanguage->reading_test) ?? 0,
            'writing' => $this->getCLB($this->writing, $this->userLanguage->writing_test) ?? 0,
            'speaking' => $this->getCLB($this->speaking, $this->userLanguage->speaking_test) ?? 0,
            'listening' => $this->getCLB($this->listening, $this->userLanguage->listening_test) ?? 0,
        ];
    }
}
