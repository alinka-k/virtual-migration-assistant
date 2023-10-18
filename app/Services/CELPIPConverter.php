<?php

namespace App\Services;

use App\Models\User\UserLanguage;

class CELPIPConverter implements LanguageConverterInterface
{
    private const TEST = 'CELPIP';

    /**
     * @var UserLanguage
     */
    private UserLanguage $userLanguage;

    public function __construct(UserLanguage $userLanguage)
    {
        $this->userLanguage = $userLanguage;
    }

    public function supports($languageTest): bool
    {
        return $languageTest === self::TEST;
    }

    public function convertToCLB(): float
    {
        return round(collect(
            [
                $this->userLanguage->reading_test,
                $this->userLanguage->writing_test,
                $this->userLanguage->speaking_test,
                $this->userLanguage->listening_test
            ]
        )->avg());
    }

    public function convertByTypes(): array
    {
        return [
            'reading' => $this->userLanguage->reading_test ?? 0,
            'writing' => $this->userLanguage->writing_test ?? 0,
            'speaking' => $this->userLanguage->speaking_test ?? 0,
            'listening' => $this->userLanguage->listening_test ?? 0,
        ];
    }
}
