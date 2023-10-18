<?php

namespace App\Services;

class SkilledOccupationChecker
{
    public function isSkilled(string $occupationId): bool
    {
        if (strlen($occupationId) < 2) {
            return false;
        }
        if (($occupationId[0] === '0')
            || in_array($occupationId[1], ['0', '1', '2'])
            || $occupationId[1] === '3'
            && in_array($occupationId[0], ['1', '4', '6', '7'])) {
            return true;
        }
        return false;
    }
}
