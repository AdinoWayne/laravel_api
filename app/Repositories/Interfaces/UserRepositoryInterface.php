<?php
namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
   public function create(array $attributes);

   public function all(array $columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');
}