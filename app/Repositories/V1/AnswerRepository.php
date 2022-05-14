<?php

namespace App\Repositories\V1;

use App\Models\V1\Answer;
use App\Repositories\V1\BaseRepository;

/**
 * This is a wrapper class for answer model.
 *
 */

class AnswerRepository extends BaseRepository
{
    protected $model;

    /**
     * Instantiate new object
     * @param Answer $model
     */
    public function __construct(Answer $model)
    {
        $this->model = $model;
    }

}
