<?php

namespace App\Services;

use App\Models\User\UserLanguage;

class TEFConverter extends LanguageTestConverter implements LanguageConverterInterface
{
    private const TEST = 'TEF';
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
            0 => range(0, 120),
            4 => range(121, 150),
            5 => range(151, 180),
            6 => range(181, 206),
            7 => range(207, 232),
            8 => range(233, 247),
            9 => range(248, 262),
            10 => range(263, 300),
        ];

        $this->writing = [
            0 => range(0, 180),
            4 => range(181, 225),
            5 => range(226, 270),
            6 => range(271, 309),
            7 => range(310, 348),
            8 => range(349, 370),
            9 => range(371, 392),
            10 => range(393, 450),
        ];

        $this->listening = [
            0 => range(0, 144),
            4 => range(145, 180),
            5 => range(181, 216),
            6 => range(217, 248),
            7 => range(249, 279),
            8 => range(280, 297),
            9 => range(298, 315),
            10 => range(316, 360),
        ];

        $this->speaking = [
            0 => range(0, 180),
            4 => range(181, 225),
            5 => range(226, 270),
            6 => range(271, 309),
            7 => range(310, 348),
            8 => range(349, 370),
            9 => range(371, 392),
            10 => range(393, 450),
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
