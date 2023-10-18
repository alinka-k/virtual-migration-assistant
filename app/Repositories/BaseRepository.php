<?php

namespace App\Repositories;

use App\Repositories\Contract\RepositoryContract;
use App\Repositories\Exceptions\RepositoryException;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;

abstract class BaseRepository implements RepositoryContract
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Application $app
     * @throws RepositoryException
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model);

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Find all entities.
     *
     * @param bool  $active
     * @param array $columns
     * @return Collection
     */
    public function findAll(bool $active = false, array $columns = ['*'])
    {
        $query = $this->model->query();

        if (method_exists($this->model, 'whenActive')) {
            $query->whenActive($active);
        }

        return $query->get($columns);
    }

    /**
     * Find an entity by id.
     *
     * @param int   $id
     * @param bool  $active
     * @param array $columns
     * @return Model|static|null
     */
    public function find(int $id, bool $active = false, array $columns = ['*'])
    {
        $query = $this->model->where('id', $id);

        if (method_exists($this->model, 'whenActive')) {
            $query->whenActive($active);
        }

        return $query->first($columns);
    }

    /**
     * Create a new entity.
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model = $this->model->newInstance();
        $model->fill($attributes);
        $model->save();

        return $model;
    }

    /**
     * Update an entity by id.
     *
     * @param array $attributes
     * @param int   $id
     * @return mixed
     */
    public function update(array $attributes, int $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        $model->save();

        return $model;
    }

    /**
     * Delete an entity by id.
     *
     * @param int $id
     * @return int
     * @throws Exception
     */
    public function delete(int $id)
    {
        $model = $this->find($id);

        return $model->delete();
    }


    /**
     * Force delete an entity by id.
     *
     * @param int $id
     * @return int
     */
    public function forceDelete(int $id)
    {
        $model = $this->find($id);

        return $model->forceDelete();
    }

    /**
     * Count all entities.
     *
     * @return mixed
     */
    public function countAll()
    {
        return $this->model->count();
    }
}
