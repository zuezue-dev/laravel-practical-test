<?php

namespace App\Repositories\V1;


class BaseRepository
{
    /**
     * Find By Column and Value
     *
     * @param mixed $value
     * @param string $column
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findBy($value, $column = 'id')
    {
        try {
            return $this->model->where($column, $value)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return $ex->getMessage();
        }
        
    }

    /**
     * save data to database
     *
     * @param Array data 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function save($data)
    {
        try {
            return $this->model->create($data);
        } catch (\Illuminate\Database\QueryException $ex) {
            //Do proper exception handling here
            throw $ex;
        }
    }
}
