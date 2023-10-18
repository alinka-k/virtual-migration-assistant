<?php

namespace App\Services;

interface LanguageConverterInterface
{
    public function supports($languageTest);

    public function convertToCLB();

    public function convertByTypes();
}
