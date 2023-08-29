<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

abstract class AbstractEloquentRepository implements BaseRepository
{
    /**
     * Name of the Model with absolute namespace
     *
     * @var string
     */
    protected $modelName;

    /**
     * Instance that extends Illuminate\Database\Eloquent\Model
     *
     * @var Model|Builder
     */
    protected $model;

    /**
     * get logged in user
     *
     * @var User $loggedInUser
     */
    protected $loggedInUser;

    /**
     * AbstractEloquentRepository constructor.
     *
     * @param Model|Builder $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->loggedInUser = $this->getLoggedInUser();
    }

    /**
     * Get Model instance
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @inheritdoc
     */
    public function findOne($id, array $relations = null)
    {
        $builder = null;
        if (!empty($relations)) {
            $builder = function (Builder $builder) use ($relations) {
                return $builder->with($relations);
            };
        }
        return $this->findOneBy(['id' => $id], $builder);
    }

    /**
     * @inheritdoc
     */
    public function findOneBy(array $criteria, \Closure $builder = null)
    {
        $queryBuilder = $this->model->where($criteria);
        if (is_callable($builder)) {
            $builder($queryBuilder);
        }
        return $queryBuilder->first();
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], \Closure $builder = null, $paginate = true, $getValue = true)
    {
        $limit = !empty($searchCriteria['limit']) ? (int)$searchCriteria['limit'] : 15; // it's needed for pagination
        $filter = !empty($searchCriteria['filter']) ? (array)$searchCriteria['filter'] : [];
        $sort = !empty($searchCriteria['sort']) ? (string)$searchCriteria['sort'] : '';
        $selected = isset($searchCriteria['selected']) ? (array)$searchCriteria['selected'] : [];
        $searchFulltext = isset($searchCriteria['search']) ? (array)$searchCriteria['search'] : [];
        $searchMultiColumn = !empty($searchCriteria['search_columns']) ? (string)$searchCriteria['search_columns'] : null;

        $queryBuilder = $this->model->where(function ($query) use ($searchMultiColumn, $filter, $sort) {
            $this->applySearchColumnsCriteriaInQueryBuilder($query, $searchMultiColumn);
            $this->applySearchCriteriaInQueryBuilder($query, $filter);
        });

        if ($sort !== '') {
            $this->applySortingInQueryBuilder($queryBuilder, $sort);
        }

        if ($searchFulltext) {
            $this->applySearchFulltext($queryBuilder, $searchFulltext);
        }

        if (count($selected) > 0) {
            $this->applySelectedInQueryBuilder($queryBuilder, $selected);
        }

        if (is_callable($builder)) {
            $builder($queryBuilder);
        }

        if ($paginate) {
            return $queryBuilder->paginate($limit);
        }

        if (!$getValue) {
            return $queryBuilder;
        }

        return $queryBuilder->get();
    }

    /**
     * @param Builder $queryBuilder
     * @param array $searchCriteria
     * @return mixed
     */
    protected function applySearchFulltext($queryBuilder, array $searchCriteria = [])
    {
        foreach ($searchCriteria as $key => $value) {
            $field = $value['field'];
            $q = array_map('trim', array_filter(explode(",", $value['value']), 'strlen'));

            if (count($q) > 1) {
                $queryBuilder->where(function($query) use ($field, $q) {
                    foreach ($q as $kS => $vS) {
                        if ($kS === 0) {
                            $query->where($field, 'like', "%$vS%");
                        } else {
                            $query->orWhere($field, 'like', "%$vS%");
                        }
                    }
                });
            } else {
                $queryBuilder->where($value['field'], 'like', "%{$q[0]}%");
            }
        }

        return $queryBuilder;
    }


    /**
     * Apply condition on query builder based on search criteria
     *
     * @param Builder $queryBuilder
     * @param array $searchCriteria
     * @return mixed
     */
    protected function applySearchCriteriaInQueryBuilder($queryBuilder, array $searchCriteria = [])
    {
        foreach ($searchCriteria as $key => $value) {

            // skip pagination related query params and ambiguous fields
            if (in_array($key, ['page', 'per_page', 'limit', 'deleted_at'])) {
                continue;
            }

            if (
                in_array($key, ['date']) &&
                in_array(
                    $value['key'] ?? '',
                    [
                        'updated_at',
                        'created_at',
                        'publish_time',
                        'published_date'
                    ]
                )
            ) {
                $timeZone = \Carbon\Carbon::now();
                $timeZoneLocal = \Carbon\Carbon::parse($timeZone, $value['timezone'] ?? null);
                $hourDiff = $timeZone->diffInHours($timeZoneLocal);

                $fromDate = Carbon::parse($value['from'])->startOfDay()->addHours(-$hourDiff);
                $toDate = Carbon::parse($value['to'])->endOfDay()->addHours(-$hourDiff);

                $queryBuilder->whereBetween($value['key'], [
                    $fromDate,
                    $toDate,
                ]);
                continue;
            }

            // TODO fix this stub
            if (is_array($value)) {
                $allValues = $value;
            } else {
                $allValues = explode(',', $value);
            }

            if (count($allValues) > 1) {
                $queryBuilder->whereIn($key, $allValues);
            } elseif (strpos($value, '!') === 0) {
                $operator = '!=';
                $value = substr($value, 1);
                $queryBuilder->where($key, $operator, $value);
            } else {
                $operator = '=';
                $queryBuilder->where($key, $operator, $value);
            }
        }

        return $queryBuilder;
    }

    /**
     * Apply condition on query builder based on search criteria
     *
     * @param \Illuminate\Database\Query\Builder|\Jenssegers\Mongodb\Eloquent\Builder $queryBuilder
     * @param string $sortString
     * @return mixed
     */
    protected function applySortingInQueryBuilder($queryBuilder, $sortString = null)
    {
        $sortFields = array_map('trim', explode(',', $sortString));
        if (count($sortFields) > 0) {
            foreach ($sortFields as $field) {
                if (empty($field)) {
                    continue;
                }
                if (strpos($field, '-') === 0) {
                    $field = substr($field, 1);
                    if ($field) {
                        $queryBuilder->orderByDesc($field);
                    }
                } else {
                    $queryBuilder->orderBy($field);
                }
            }
        }

        return $queryBuilder;
    }

    /**
     * Apply condition on query builder based on search criteria
     *
     * @param \Illuminate\Database\Query\Builder|\Jenssegers\Mongodb\Eloquent\Builder $queryBuilder
     * @param array $selectedArray
     *
     * @return mixed
     */
    protected function applySelectedInQueryBuilder($queryBuilder, $selectedArray = [])
    {
        $key = $selectedArray['key'] ?? '';
        $values = $selectedArray['values'] ?? '';
        $valueArr = array_map('trim', explode(',', $values));

        if (in_array($key, ['id']) === false) {
            return $queryBuilder;
        }

        if ($valueArr && count($valueArr) > 0) {
            foreach ($valueArr as $value) {
                if (empty($value)) {
                    continue;
                }

                $queryBuilder->orderByRaw(vsprintf('%s = "%s" %s', [
                    $key,
                    $value,
                    'DESC'
                ]));
            }
        } else {
            $queryBuilder->orderByRaw(vsprintf('%s = "%s" %s', [
                $key,
                $values,
                'DESC'
            ]));
        }

        return $queryBuilder;
    }

    /**
     * @inheritdoc
     */
    public function save(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update(Model $model, array $data)
    {
        $fillAbleProperties = $this->model->getFillable();

        foreach ($data as $key => $value) {

            // update only fillAble properties
            if (in_array($key, $fillAbleProperties)) {
                $model->$key = $value;
            }
        }

        $model->save();

        // get updated model from database
        $model = $this->findOne($model->id);

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function findIn($key, array $values)
    {
        return $this->model->whereIn($key, $values)->get();
    }

    /**
     * @param Model $model
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }

    /**
     * get loggedIn user
     *
     * @return User
     */
    protected function getLoggedInUser()
    {
        $user = user();

        if ($user instanceof User) {
            return $user;
        } else {
            return new User();
        }
    }

    /**
     * @param Model $model
     * @param array $data
     * @return Builder|Model|object|null
     */
    public function updateMongo(Model $model, array $data)
    {
        $fillAbleProperties = $this->model->getFillable();

        foreach ($data as $key => $value) {

            // update only fillAble properties
            if (in_array($key, $fillAbleProperties)) {
                $model->$key = $value;
            }
        }

        $model->save();

        // get updated model from database
        $model = $this->findOneBy(['_id' => $model->_id]);

        return $model;
    }

    /**
     * Remove all global scopes
     * Excep
     *
     * @return $this
     */
    public function withoutGlobalScopes()
    {
        $scopes = $this->model->getGlobalScopes();

        // Remove some default scope
        $exceptions = [
            'Illuminate\Database\Eloquent\SoftDeletingScope'
        ];
        foreach ($exceptions as $item) {
            unset($scopes[$item]);
        }

        $scopes = array_keys($scopes);

        $this->model = $this->model->withoutGlobalScopes($scopes);

        return $this;
    }

    /**
     * Apply condition on query builder based on search criteria
     *
     * @param Object $queryBuilder
     * @param string|null $search
     * @return mixed
     */
    protected function applySearchColumnsCriteriaInQueryBuilder($queryBuilder, ?string $search)
    {
        if (!$search) {
            return $queryBuilder;
        }
        return $queryBuilder->search($search, false);
    }
}
