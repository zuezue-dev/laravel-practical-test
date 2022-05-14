<?php

namespace App\Models\V1;

use App\Traits\V1\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Survey extends Model
{
    use HasFactory;
    use Uuid;

    protected $with = ['questions']; //Eager Load approach //need to do it for every survey model query in this case.


    protected $fillable = ['name', 'uuid'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Get the questions for the survey.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * validation rules of the survey.
     *
     * @return mixed
     */
    public function getRulesAttribute()
    {
        $questionsRules = $this->questions->mapWithKeys(function ($question) {
            return [$question->key => 'required'];
        })->all();
        return array_merge($questionsRules, ["email" => "required|email"]);
    }
}
