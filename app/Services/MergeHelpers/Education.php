<?php

namespace App\Services\MergeHelpers;

use Arr;

class Education extends BaseHelper
{
    private const EMPTY_EDUCATION = [
        'type_of_program' => 'null',
        'completed' => false,
        'duration' => 0
    ];

    public function handle()
    {
        $mergedItems = array_merge($this->generateInsideItems(), $this->generateOutsideItems());
        return [
            'highschool_completed' => !empty($mergedItems),
            'has_post_secondary_education' => !empty($mergedItems),
            'post_secondary_education' => $mergedItems ?: [self::EMPTY_EDUCATION],
        ];
    }

    protected function generateInsideItems(): array
    {
        $items = [];
        foreach (Arr::get($this->virtualProfile, 'studyInsideCanada') as $model) {
            $items[] = $this->hasMinDataForEvaluation($model->toArray()) ? $model->toArray() : self::EMPTY_EDUCATION;
        }
        return $items;
    }

    protected function generateOutsideItems(): array
    {
        $items = [];
        foreach (Arr::get($this->virtualProfile, 'studyOutsideCanada') as $model) {
            $data = array_merge($model->toArray(), [
                'completed' => 1,
                'location' => 'Other',
            ]);
            $items[] = $this->hasMinDataForEvaluation($data) ? $data : self::EMPTY_EDUCATION;
        }
        return $items;
    }

    private function hasMinDataForEvaluation($education): bool
    {
        foreach (self::EMPTY_EDUCATION as $key => $item) {
            if (!isset($education[$key]) || empty($education[$key])) {
                return false;
            }
        }
        return true;
    }
}
