<?php

namespace App\Services;

use App\Models\User\UserLanguage;

class CLBConverter
{
    private array $converters;

    /**
     * @var UserLanguage
     */
    private UserLanguage $userLanguage;

    public function __construct(UserLanguage $userLanguage)
    {
        $this->userLanguage = $userLanguage;
        $this->converters = [
            new CELPIPConverter($this->userLanguage),
            new IELTSConverter($this->userLanguage),
            new TEFConverter($this->userLanguage),
            new TCFConverter($this->userLanguage),
        ];
    }

    public function convert(): float
    {
        foreach ($this->converters as $converter) {
            if ($converter->supports($this->userLanguage->language_test)) {
                return $converter->convertToCLB();
            }
        }
        return $this->getSelfAssessmentAverage();
    }

    public function convertByTypes(): array
    {
        foreach ($this->converters as $converter) {
            if ($converter->supports($this->userLanguage->language_test)) {
                /** @var LanguageConverterInterface $converter */
                return $converter->convertByTypes();
            }
        }
        return $this->userLanguage->only('writing', 'reading', 'speaking', 'listening');
    }

    private function getSelfAssessmentAverage(): float
    {
        return round(collect(
            $this->userLanguage->only(
                'writing',
                'reading',
                'speaking',
                'listening'
            )
        )->avg());
    }
}
