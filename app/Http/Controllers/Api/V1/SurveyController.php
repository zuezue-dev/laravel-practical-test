<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\V1\SurveyRepository;
use App\Http\Requests\SurveyQuestionRequest;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends Controller
{
    protected $repo;
    public function __construct(SurveyRepository $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     * store survey along with questions
     * 
     * @param Illuminate\Http\Request
     */
    public function store(SurveyQuestionRequest $request) {

        $survey = $this->repo->save($request->only(['name']));

        foreach($request->questions as $question) {
            $survey->questions()->create($question);
        }

        return response()->json([
            'url' => config('app.url')."/survey/". $survey->uuid
        ], Response::HTTP_OK);
    }

}


