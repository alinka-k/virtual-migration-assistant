<?php

namespace App\Services\Points\Programs;

use App\Models\Evaluate\Evaluation;
use App\Services\Points\Programs\Helpers\NetWorthHelper;
use App\Services\Points\Programs\Helpers\WorkHelper;
use Arr;

class FSTProgram
{
    public function prepareData(array $data, Evaluation $evaluation, array $strapiData = []): array
    {
        $payload = json_decode(Arr::get($evaluation, 'payload', ''), true);
        $requirements = [];
        $works = [];

        foreach (Arr::get($payload, 'work.history', []) as $work) {
            $works[] = [
                'skillType' => WorkHelper::getTypeOfWork(Arr::get($work, 'noc', '')),
                'location' => Arr::get($work, 'location', ''),
                'when' => Arr::get($work, 'when', 100),
                'duration' => Arr::get($work, 'duration', 0),
                'noc' => Arr::get($work, 'noc', ''),
            ];
        }

        foreach ($data as $rule) {
            if ($rule['rule_id'] !== 0) {
                $requirements[] = [
                    'text' => Arr::get($rule, 'Text', ''),
                    'checked' => $this->prepareRules($rule, $evaluation, $works),
                ];
            }
        }

        return $requirements;
    }

    private function prepareRules(array $rule, Evaluation $evaluation, array $works = []): bool
    {
        $payload = json_decode(Arr::get($evaluation, 'payload', ''), true);
        $rule_id = $rule['rule_id'];

        if ($rule_id === 1) {
            return Arr::get($payload, 'language.english.speaking', 0) >= 5 && Arr::get($payload, 'language.english.listening', 0) >= 5;
        }

        if ($rule_id === 2) {
            return Arr::get($payload, 'language.english.reading', 0) >= 4 && Arr::get($payload, 'language.english.writing', 0) >= 4;
        }

        if ($rule_id === 3) {
            foreach ($works as $work) {
                if ($work['location'] === 'Canada' && $work['when'] <= 5 && $work['duration'] >= 2 && WorkHelper::isUnderFSTPList($work['noc'])) {
                    return true;
                }
            }
        }

        if ($rule_id === 4) {
            $has_offer = Arr::get($payload, 'canadian_job_offer.has_offer', false);
            $duration = Arr::get($payload, 'canadian_job_offer.job_offer.duration', 0);
            $schedule_type = Arr::get($payload, 'canadian_job_offer.job_offer.schedule_type', '');
            $bc_industry_training_authority_certificate = Arr::get($payload, 'canadian_job_offer.job_offer.bc_industry_training_authority_certificate', 'No');
            return ($has_offer && $duration && $schedule_type == 'Full Time') || ($has_offer && $bc_industry_training_authority_certificate === 'Yes');
        }

        if ($rule_id === 5) {
            return NetWorthHelper::isNetWorthForFamilyValid($payload);
        }

        return false;
    }
}
