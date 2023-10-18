<?php

namespace App\Services\Points\Programs;

use App\Models\Evaluate\Evaluation;
use App\Services\Points\Programs\Helpers\NetWorthHelper;
use Arr;

class FSWProgram
{
    public function prepareData(array $data, Evaluation $evaluation, array $fsw_log): array
    {
        $requirements = [];

        foreach ($data as $rule) {
            if ($rule['rule_id'] !== 0) {
                $requirements[] = [
                    'text' => Arr::get($rule, 'text', ''),
                    'infoBubble' => Arr::get($rule, 'info_bubble', ''),
                    'checked' => $this->prepareRules($rule, $evaluation, $fsw_log),
                ];
            }
        }

        return $requirements;
    }

    private function prepareRules(array $rule, Evaluation $evaluation, array $fsw_log): bool
    {
        $payload = json_decode(Arr::get($evaluation, 'payload', ''), true);
        $rule_id = $rule['rule_id'];

        if ($rule_id === 1) {
            return Arr::get($fsw_log, 'log.fsw_work_experience_score', 0) >= 9;
        }

        if ($rule_id === 2) {
            return Arr::get($fsw_log, 'log.fsw_1st_language_score', 0) >= 16;
        }

        if ($rule_id === 3) {
            return Arr::get($fsw_log, 'log.fsw_education_score', 0) >= 5;
        }

        if ($rule_id === 4) {
            return Arr::get($fsw_log, 'value', 0) > 67;
        }

        if ($rule_id === 5) {
            return NetWorthHelper::isNetWorthForFamilyValid($payload);
        }

        return false;
    }
}
