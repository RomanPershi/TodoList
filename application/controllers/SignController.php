<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/application/models/User.php");


class SignController extends Controller
{
    public function invoke()
    {
        $this->generatePageWithLayot('Sign/Signin.php',['content_view' => 'main.php']);
    }
    public function signup()
    {
        $this->generatePageWithLayot('Sign/Signup.php',['content_view' => 'main.php']);
    }

    public function signout()
    {
        session_destroy();
        header('Location: main');
    }
}