<?php

namespace App\Http\Controllers\V1;

use App\Models\V1\Survey;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    public function create(Survey $survey)
    {
        return view('survey-form', ['survey' => $survey]);
    }
}
