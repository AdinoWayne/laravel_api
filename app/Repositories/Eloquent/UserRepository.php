<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;
    /**
     * Specify Model class name
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param array $attributes
     * @return mixed
    */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function all(array $attributes,string $orderBy,string $sortBy, string $columns)
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

}