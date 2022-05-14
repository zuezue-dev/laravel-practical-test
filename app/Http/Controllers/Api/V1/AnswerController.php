<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\V1\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\V1\AnswerRepository;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{
    //
    protected $repo;
    public function __construct(AnswerRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * store answers from the survey form questions
     * 
     * @param Illuminate\Http\Request
     * @param App\Models\V1\Survey
     */
    public function store(Request $request, Survey $survey)
    {
        $this->validate($request, $survey->rules);

        foreach ($request->except(['email']) as $key => $value) {
            if ($value === null) continue;

            if (gettype($value) === 'array') $value = implode(', ', $value);

            preg_match('/\D+(\d+)$/', $key, $matches);

            $answersArr = [
                'question_id' => $matches[1],
                'value' => $value,
            ];
            $this->repo->save($answersArr);
        }

        dispatch(new \App\Jobs\SuccessEmailJob($survey, $request->email));

        return response()->json([
            'message' => 'Thank you for answering the survey.'
        ], Response::HTTP_OK);
    }
}
