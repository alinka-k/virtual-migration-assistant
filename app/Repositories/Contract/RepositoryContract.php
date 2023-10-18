<?php

namespace App\Repositories\Contract;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryContract
{
    /**
     * Find all entities.
     *
     * @param bool  $active
     * @param array $columns
     * @return Collection
     */
    public function findAll(bool $active = false, array $columns = ['*']);

    /**
     *  Find a entity by id.
     *
     * @param int   $id
     * @param bool  $active
     * @param array $columns
     * @return Model|static|null
     */
    public function find(int $id, bool $active = false, array $columns = ['*']);

    /**
     * Create a new entity.
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update a entity by id.
     *
     * @param array $attributes
     * @param int   $id
     * @return mixed
     */
    public function update(array $attributes, int $id);

    /**
     * Delete a entity by id.
     *
     * @param int $id
     * @return int
     */
    public function delete(int $id);

    /**
     * Force delete an entity by id.
     *
     * @param int $id
     * @return int
     */
    public function forceDelete(int $id);

    /**
     * Count all entities.
     *
     * @return mixed
     */
    public function countAll();
}
