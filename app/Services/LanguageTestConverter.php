<?php

namespace App\Services;

class LanguageTestConverter
{
    protected function getCLB($languageTest, $userGrade)
    {
        foreach ($languageTest as $CLBGrade => $languageTestGrade) {
            if (in_array($userGrade, $languageTestGrade)) {
                return $CLBGrade;
            }
        }
    }
}
