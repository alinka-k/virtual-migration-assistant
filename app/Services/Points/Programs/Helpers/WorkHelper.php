<?php

namespace App\Services\Points\Programs\Helpers;

class WorkHelper
{
    const NOC_CODES_FOR_FSTP = [
        'twoNumbersCode' => ['72', '73', '82', '92'],
        'threeNumbersCode' => ['632', '633'],
    ];

    public static function getTypeOfWork(string $noc = ''): string
    {
        if (strlen($noc) < 2) {
            return '';
        }

        if ($noc[0] == '0' && $noc[1] == '0') {
            return '00';
        }
        if ($noc[0] == '0') {
            return '0';
        }
        switch ($noc[1]) {
            case '0':
            case '1':
                return 'A';
            case '2':
                return 'B';
            case '3':
                if (in_array($noc[0], ['1', '4', '6', '7'])) {
                    return 'B';
                }
                return 'C';
            case '4':
            case '5':
                return 'C';
            case '6':
            case '7':
                return 'D';
        }
        return '';
    }

    public static function isUnderFSTPList(string $noc = ''): bool
    {
        if (strlen($noc) < 3) {
            return false;
        }
        if (in_array(mb_substr($noc, 0, 2), self::NOC_CODES_FOR_FSTP['twoNumbersCode'])) {
            return true;
        }
        if (in_array(mb_substr($noc, 0, 3), self::NOC_CODES_FOR_FSTP['threeNumbersCode'])) {
            return true;
        }
        return false;
    }
}
