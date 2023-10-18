<?php

namespace App\Repositories;

use App\Models\User\UserProfile;
use App\Models\VirtualProfile;
use App\Repositories\Contract\ProfileRepositoryContract;
use Illuminate\Support\Arr;

class ProfileRepository extends BaseRepository implements ProfileRepositoryContract
{
    protected $model = UserProfile::class;

    public function getWhere(array $params)
    {
        return $this->model->where($params)->get();
    }
}
