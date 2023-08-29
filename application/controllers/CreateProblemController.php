<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/application/models/User.php");


class CreateProblemController extends Controller
{
    public function invoke($error = null)
    {
        $data = $error == null ? ['content_view' => 'main.php'] : ['content_view' => 'main.php','error' => $error];
        $this->generatePageWithLayot('CreateProblem/content.php',$data);
    }
}