<?php

namespace App\Repositories\V1;

use App\Models\V1\Survey;
use App\Repositories\V1\BaseRepository;

/**
 * This is a wrapper class for survey model.
 *
 */

class SurveyRepository extends BaseRepository
{
    protected $model;

    /**
     * Instantiate new object
     * @param Survey $model
     */
    public function __construct(Survey $model)
    {
        $this->model = $model;
    }

    /**
     * save data to database
     *
     * @param Array data 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function saveQuestions($survey, $data)
    {
        return $survey->questions()->createMany($data);
    }

}
