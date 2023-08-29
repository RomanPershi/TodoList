<?php

class Controller {
	public $model;
	public $view;
	
	function __construct()
	{
		$this->view = new View();
	}
    protected function generatePageWithLayot($template_view,$content_view,$main_template = 'layouts/main.php')
    {
        $content = $this->view->render($template_view,$content_view);
        $this->view->generate($main_template,['content' => $content]);
    }
}
