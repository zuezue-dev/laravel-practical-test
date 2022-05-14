<?php

function getSurveyFormUrl($survey)
{
    return config('app.url')."/form/". $survey->uuid;
}