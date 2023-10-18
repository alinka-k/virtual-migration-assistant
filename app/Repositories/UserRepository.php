<?php

namespace App\Repositories;

use App\Enums\UserStatus;
use App\Models\User;
use App\Repositories\Contract\UserRepositoryContract;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class UserRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class UserRepository extends BaseRepository implements UserRepositoryContract
{
    protected $model = User::class;


    /**
     * Find a user by email.
     *
     * @param string $email
     * @param bool $active
     * @param array $columns
     * @return Model|static|null
     */
    public function findByEmail(string $email, bool $active = false, array $columns = ['*'])
    {
        return $this->model
            ->where('email', $email)
//            ->whenActive($active)
            ->first($columns);
    }

    /**
     * @param int $id
     * @return Model|static|null
     */
    public function findNotVerified(int $id)
    {
        return $this->model
            ->where([
                'id' => $id,
                'status' => UserStatus::InActive,
            ])
            ->whereNull('email_verified_at')
            ->first(['*']);
    }

    /**
     * Create an entity.
     *
     * @param array $attributes
     * @return User | false
     * @throws Throwable
     */
    public function create(array $attributes)
    {
        DB::beginTransaction();

        try {
            $user = $this->model->newInstance();
            $user->fill($attributes);
            $user->status = UserStatus::InActive;
            $user->password = bcrypt($attributes['password']);
            $user->save();

            DB::commit();

            return $user;
        } catch (Exception $e) {
            Log::critical($e);
            DB::rollback();

            return false;
        }
    }

    /**
     * Create a new member user entity.
     *
     * @param array $attributes
     * @return mixed
     */
    public function createMember(array $attributes)
    {
        /** @var User $model */
        $model = $this->model->newInstance();
        $model->fill($attributes);
        $model->status = UserStatus::InActive;
        $model->save();

        return $model;
    }

    /**
     * Update an entity by id.
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     * @throws Throwable
     */
    public function update(array $attributes, int $id)
    {
        DB::beginTransaction();

        try {
            $user = $this->model->find($id);
            $user->fill($attributes);
            $user->is_active = true;
            $user->save();


            if (Arr::get($attributes, 'security_answer')) {
                $user->securityAnswer()->updateOrCreate([], $attributes['security_answer']);
            }

            DB::commit();

            return $user;
        } catch (Exception $e) {
            Log::critical($e);
            DB::rollback();

            return false;
        }
    }

    public function findNotEvaluated()
    {
        return $this->model->select('id')->whereDate('updated_at', today())->withCount('evaluations')->having('evaluations_count', '<', 1)->get();
    }
}
