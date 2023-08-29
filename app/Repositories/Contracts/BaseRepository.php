<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepository
{
    /**
     * Find a resource by id
     *
     * @param  array  $relations
     * @return Model|null
     */
    public function findOne($id, array $relations = null);

    /**
     * Find a resource by criteria
     *
     * @return Model|null
     */
    public function findOneBy(array $criteria, \Closure $builder = null);

    /**
     * Search All resources by criteria
     *
     * @param  bool  $paginate
     * @param  bool  $getValue
     * @return Collection
     */
    public function findBy(array $searchCriteria = [], \Closure $builder = null, $paginate = true, $getValue = true);

    /**
     * Search All resources by any values of a key
     *
     * @param  string  $key
     * @return Collection
     */
    public function findIn($key, array $values);

    /**
     * Save a resource
     *
     * @return Model
     */
    public function save(array $data);

    /**
     * Update a resource
     *
     * @return Model
     */
    public function update(Model $model, array $data);

    /**
     * Delete a resource
     *
     * @return mixed
     */
    public function delete(Model $model);

    /**
     * @return $this
     */
    public function withoutGlobalScopes();
}
