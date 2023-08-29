<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/application/models/User.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/application/models/Problem.php");


class ShowProblemsController extends Controller
{
    public function invoke()
    {
        $paginate = 3;
        $problem = new Problem();
        $data = $this->validate(['page','status','login','email','text']);
        if ((isset($data['login']) && $data['login'] === 'Неизвестный') || (isset($data['email']) && $data['email'] === 'Неизвестный')) {
            $problems = $problem->witoutUsersPaginate($paginate, $data);
        } else {
            $problems = $problem->paginate($paginate, $data);
        }
        $this->generatePageWithLayot('ShowProblems/content.php',
            ['problems' => $problems['problems'],
                'data' => $data,
                'maxPages' => ceil($problems['totalCount'] / $paginate),
            'content_view' => 'main.php']);
    }
    protected function validate($keys)
    {
        $data = [];
        $data['page'] = 1;
        foreach ($keys as $key)
        {
            if (isset($_GET[$key]) && $_GET[$key] != ''){
                $data[$key] = $_GET[$key];
            }
        }
        return $data;
    }
}