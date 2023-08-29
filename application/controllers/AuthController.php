<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/application/models/User.php");


class AuthController extends Controller
{
    public function invoke()
    {
        $user = new User();
        $cur_user = $user->find(["login" => $_POST['login']]);
        if ($this->checkAccess($cur_user)) {
            $this->autorization($cur_user);
            header('Location: main');
        }
        else{
            $this->onError("signin","Неверный логин или пароль");
        }
    }
    protected function onError($location,$error)
    {
        header('Location: '.$location.'?error='.$error);
    }
    protected function checkAccess($cur_user)
    {
        return $cur_user && $_POST['password'] == $cur_user['password'];
    }
    protected function autorization($cur_user)
    {
        $_SESSION['user_id'] = $cur_user['id'];
        $_SESSION['login'] = $cur_user['login'];
        $_SESSION['email'] = $cur_user['email'];
        $_SESSION['role'] = (int)$cur_user['role_id'];
    }
    protected function validate($data) {
        $user = new User();
        $errors = [];
        if($user->find(["login" => $_POST['login'],"email" => $_POST['email']],"OR")) {
            $errors[] = "Данный логин или email уже используются";
        }

        if (empty($data['login'])) {
            $errors[] = "Логин не может быть пустым";
        }

        if (empty($data['email'])) {
            $errors[] = "Email не может быть пустым";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Некорректный формат email";
        }

        if (empty($data['password'])) {
            $errors[] = "Пароль не может быть пустым";
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $g_error = $error . "<br>";
            }
            return $g_error;
        }
        return false;
    }
    public function register()
    {
        $user = new User();
        if(!$this->validate($_POST)) {
            $this->autorization(array_merge($user->create(["password" => $_POST['password'],"login" => $_POST['login'],"email" => $_POST['email']]), ["role_id" => 1]));
            header('Location: main');
        }
        else{$this->onError("signup",$this->validate($_POST));}
    }
}