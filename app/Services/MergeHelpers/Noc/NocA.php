<?php

namespace App\Services\MergeHelpers\Noc;

class NocA implements NocInterface
{
    public function getOccupation(): string
    {
        return 'Software Engineer';
    }

    public function getNoc(): string
    {
        return '2173';
    }
}
