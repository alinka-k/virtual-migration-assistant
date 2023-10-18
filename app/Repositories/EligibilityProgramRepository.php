<?php

namespace App\Repositories;

use App\Models\Evaluate\EligibilityProgram;
use App\Repositories\Contract\EligibilityProgramRepositoryContract;
use Illuminate\Support\Arr;

class EligibilityProgramRepository extends BaseRepository implements EligibilityProgramRepositoryContract
{
    protected $model = EligibilityProgram::class;

    /**
     * @param array $ids
     * @param array $columns
     * @return array
     */
    public static function findAllById($ids, array $columns = ['*'])
    {
        $query = EligibilityProgram::whereIn('program_id', $ids);

        return Arr::pluck($query->get(), $columns);
    }

    /**
     * @param array $ids
     * @param array $columns
     * @return array
     */
    public static function getLabelsByIds($ids)
    {
        return self::findAllById($ids, ['label']);
    }
}
