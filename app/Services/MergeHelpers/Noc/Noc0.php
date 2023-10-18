<?php

namespace App\Services\MergeHelpers\Noc;

class Noc0 implements NocInterface
{
    public function getOccupation(): string
    {
        return 'CFO';
    }

    public function getNoc(): string
    {
        return '0016';
    }
}
