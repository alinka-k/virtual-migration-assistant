<?php

namespace App\Services\Points\Programs;

use App\Models\Evaluate\Evaluation;
use App\Services\Points\Programs\Helpers\WorkHelper;
use Arr;

class CECProgram
{
    public function prepareData(array $data, Evaluation $evaluation, array $strapiData = []): array
    {
        $payload = json_decode(Arr::get($evaluation, 'payload', ''), true);
        $requirements = [];
        $works = [];
//        $hasPermissionForProgram = false;

        foreach (Arr::get($payload, 'work.history', []) as $work) {
//            $skillType = WorkHelper::getTypeOfWork(Arr::get($work, 'noc', ''));
//            if ($skillType === '0' || $skillType === 'A' || $skillType === 'B') {
//                $hasPermissionForProgram = true;
//            }
            $works[] = [
                'skillType' => WorkHelper::getTypeOfWork(Arr::get($work, 'noc', '')),
                'location' => Arr::get($work, 'location', ''),
                'when' => Arr::get($work, 'when', 100),
                'duration' => Arr::get($work, 'duration', 0),
            ];
        }

        foreach ($data as $rule) {
            if ($rule['rule_id'] !== 0) {
                $requirements[] = [
                    'text' => Arr::get($rule, 'Text', ''),
                    'infoBubble' => Arr::get($rule, 'info_bubble', ''),
                    'checked' => $this->prepareRules($rule, $evaluation, $works),
                ];
            }
        }

        return $requirements;

//        if (!$hasPermissionForProgram) {
//            return [];
//        }
//
//        return [
//            'benefits' => Arr::get($strapiData, 'benefits', ''),
//            'mainText' => Arr::get($strapiData, 'main_text', ''),
//            'items' => Arr::get($strapiData, 'cec_items', []),
//            'program' => [
//                'title' => Arr::get($strapiData, 'title', ''),
//                'text' => Arr::get($strapiData, 'program_text', ''),
//                'requirements' => $requirements,
//            ]
//        ];
    }

    private function prepareRules(array $rule, Evaluation $evaluation, array $works = [])
    {
        $payload = json_decode(Arr::get($evaluation, 'payload', ''), true);

        if ($rule['rule_id'] === 1) {
            $language = [
                'reading' => Arr::get($payload, 'language.english.reading', 0),
                'writing' => Arr::get($payload, 'language.english.writing', 0),
                'speaking' => Arr::get($payload, 'language.english.speaking', 0),
                'listening' => Arr::get($payload, 'language.english.listening', 0),
            ];

            foreach ($works as $work) {
                if ($work['skillType'] === '0' || $work['skillType'] === 'A') {
                    if ($language['reading'] >= 7 && $language['writing'] >= 7 && $language['speaking'] >= 7 && $language['listening'] >= 7) {
                        return true;
                    }
                } elseif ($work['skillType'] === 'B') {
                    if ($language['reading'] >= 5 && $language['writing'] >= 5 && $language['speaking'] >= 5 && $language['listening'] >= 5) {
                        return true;
                    }
                }
            }
        }

        if ($rule['rule_id'] === 2) {
            foreach ($works as $work) {
                if ($work['location'] === 'Canada' && $work['when'] <= 3 && $work['duration'] >= 1) {
                    return true;
                }
            }
        }

        return false;
    }
}
