<?php

namespace App\Services;

use App\Models\User\UserLanguage;

class IELTSConverter extends LanguageTestConverter implements LanguageConverterInterface
{
    private const TEST = 'IELTS';

    /**
     * @var UserLanguage
     */
    private UserLanguage $userLanguage;
    private array $reading;
    private array $writing;
    private array $speaking;
    private array $listening;

    public function __construct(UserLanguage $userLanguage)
    {
        $this->userLanguage = $userLanguage;

        $this->reading = [
            4 => [3.5],
            5 => [4, 4.5],
            6 => [5, 5.5],
            7 => [6, 6.5],
            8 => [7, 7.5],
            9 => [8, 8.5],
            10 => [9],
        ];

        $this->writing = [
            4 => [4],
            5 => [4.5],
            6 => [5, 5.5],
            7 => [6, 6.5],
            8 => [7, 7.5],
            9 => [8, 8.5],
            10 => [9],
        ];

        $this->speaking = [
            4 => [4],
            5 => [4.5, 5],
            6 => [5.5],
            7 => [6, 6.5],
            8 => [7, 7.5],
            9 => [8, 8.5],
            10 => [9],
        ];

        $this->listening = [
            4 => [4.5],
            5 => [5],
            6 => [5.5],
            7 => [6, 6.5],
            8 => [7, 7.5],
            9 => [8, 8.5],
            10 => [9],
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
