<?php

namespace App\Traits\V1;

use Illuminate\Support\Str;

trait Uuid
{
    /**
     * Boot function from Laravel.
     */
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            try {
                $model->uuid = Str::uuid();
            } catch(\Exception $ex) {
                return $ex->getMessage();
            }
        });
    }

}