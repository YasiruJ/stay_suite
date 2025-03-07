<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 */
interface EloquentRepositoryInterface
{
    /**
     * @param  array  $attributes
     * @return Model
     */
    public function create(array $data);

    /**
     * @return Model
     */
    public function find($id): ?Model;

    public function getModel();
}
