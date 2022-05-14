<?php

function getSurveyFormUrl($survey)
{
    return config('app.url')."/survey/". $survey->uuid;
}