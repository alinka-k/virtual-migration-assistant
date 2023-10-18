<?php

namespace App\Services\MergeHelpers;

use Arr;

class Spouse extends BaseHelper
{
    public function handle()
    {
        $english = Arr::get($this->virtualProfile->user, 'spouse.english');
        if (Arr::get($this->virtualProfile, 'spouse.english')) {
            $english = Arr::get($this->virtualProfile, 'spouse.english');
        }
        $french = Arr::get($this->virtualProfile->user, 'spouse.french');
        if (Arr::get($this->virtualProfile, 'spouse.french')) {
            $french = Arr::get($this->virtualProfile, 'spouse.french');
        }

        $foreign_exp_years = Arr::get($this->virtualProfile->user, 'spouse.foreign_exp_years');
        $noc_0 = $this->getYears('spouse.inside.noc_0');
        $noc_A = $this->getYears('spouse.inside.noc_A');
        $noc_B = $this->getYears('spouse.inside.noc_B');
        $noc_C_D = $this->getYears('spouse.inside.noc_C_D');
        if ($noc_0 || $noc_A || $noc_B || $noc_C_D) {
            $foreign_exp_years = $noc_0 + $noc_A + $noc_B + $noc_C_D;
        }

        $canadian_exp_years = Arr::get($this->virtualProfile->user, 'spouse.canadian_exp_years');
        $out_noc_0 = $this->getYears('spouse.outside.noc_0');
        $out_noc_A = $this->getYears('spouse.outside.noc_A');
        $out_noc_B = $this->getYears('spouse.outside.noc_B');
        $out_noc_C_D = $this->getYears('spouse.outside.noc_C_D');
        if ($out_noc_0 || $out_noc_A || $out_noc_B || $out_noc_C_D) {
            $canadian_exp_years = $noc_0 + $noc_A + $noc_B + $noc_C_D;
        }

        return [
            'age' => asNumber(Arr::get($this->virtualProfile->user, 'spouse.age') * 1),
            'education_level' => Arr::get($this->virtualProfile->user, 'spouse.education_level'),
            'english' => $english,
            'french' => $french,
            'has_foreign_work' => (bool)Arr::get($this->virtualProfile->user, 'spouse.has_foreign_work'),
            'foreign_exp_years' => $foreign_exp_years,
            'has_canadian_work' => (bool)Arr::get($this->virtualProfile->user, 'spouse.has_canadian_work'),
            'canadian_exp_years' => $canadian_exp_years,
        ];
    }

    protected function getYears(string $key)
    {
        return Arr::get($this->virtualProfile, $key);
    }
}
