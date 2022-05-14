<?php

namespace App\Repositories\V1;

use App\Models\V1\User;
use App\Repositories\V1\BaseRepository;

/**
 * This is a wrapper class for user model.
 *
 */

class UserRepository extends BaseRepository
{
    protected $model;

    /**
     * Instantiate new object
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

}
