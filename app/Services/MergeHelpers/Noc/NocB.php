<?php

namespace App\Services\MergeHelpers\Noc;

class NocB implements NocInterface
{
    public function getOccupation(): string
    {
        return 'Welder';
    }

    public function getNoc(): string
    {
        return '7237';
    }
}
