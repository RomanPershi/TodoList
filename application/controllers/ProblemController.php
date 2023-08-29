<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/application/controllers/CreateProblemController.php";
include_once($_SERVER['DOCUMENT_ROOT'] . "/application/models/User.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/application/models/Problem.php");

class ProblemController extends Controller
{
    public function invoke()
    {
        if ($this->create()) {
            header('Location: main');
        } else {
            CreateProblemController::invoke("Произошла ошибка");
        }
    }
    protected function create()
    {
        $problem = new Problem();
        $data["text"] = $_POST['text'];
        if (isset($_SESSION['user_id'])){
            $data['user_id'] = $_SESSION['user_id'];
        }
        return $problem->create($data);
    }
    public function edit()
    {
        $problem = new Problem();
        $data = [
            'id' => $_POST['id'],
            'status' => isset($_POST['status']) && $_POST['status'] ? 1 : 0,
            'text' => $_POST['text'],
        ];

        if ($problem->create($data)) {
            $this->redirect();
        }
    }

    public function delete()
    {
        $problem = new Problem();
        if ($problem->deleteById($_POST['id']))
            $this->redirect();
    }
    protected function redirect()
    {
        $originalQueryParams = $_POST['original_query_params'];
        $redirectUrl = 'main';
        if (!empty($originalQueryParams)) {
            $redirectUrl .= '?' . $originalQueryParams;
        }
        header('Location: ' . $redirectUrl);
    }
}