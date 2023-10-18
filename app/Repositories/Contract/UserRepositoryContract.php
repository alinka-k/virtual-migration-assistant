<?php

namespace App\Repositories\Contract;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryContract extends RepositoryContract
{

    /**
     * Find a user by email.
     *
     * @param string $email
     * @param bool   $active
     * @param array  $columns
     * @return Model|static|null
     */
    public function findByEmail(string $email, bool $active = false, array $columns = ['*']);

    /**
     * Create an entity.
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Create Member an entity.
     *
     * @param array $attributes
     * @return mixed
     */
    public function createMember(array $attributes);

    /**
     * Update an entity by id.
     *
     * @param array $attributes
     * @param int   $id
     * @return mixed
     */
    public function update(array $attributes, int $id);

    /**
     * @return mixed
     */
    public function findNotEvaluated();
}
