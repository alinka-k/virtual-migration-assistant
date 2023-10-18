<?php

namespace App\Services\MergeHelpers\Noc;

class NocCD implements NocInterface
{
    public function getOccupation(): string
    {
        return 'Truck driver';
    }

    public function getNoc(): string
    {
        return '7511';
    }
}
