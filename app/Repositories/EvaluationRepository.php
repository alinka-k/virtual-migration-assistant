<?php

namespace App\Repositories;

use App\Models\Evaluate\Evaluation;
use App\Repositories\Contract\EvaluationRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class EvaluationRepository extends BaseRepository implements EvaluationRepositoryContract
{
    protected $model = Evaluation::class;

    /**
     * Find an entity by id.
     *
     * @param int   $id
     * @param bool  $active
     * @param array $columns
     * @return Model|static|null
     */
    public function find(int $id, bool $active = false, array $columns = ['*']): ?Evaluation
    {
        $query = $this->model->where('id', $id);

        return $query->first($columns);
    }
}
