<?php

class View
{

    //public $template_view; // здесь можно указать общий вид по умолчанию.

    /*
    $content_file - виды отображающие контент страниц;
    $template_file - общий для всех страниц шаблон;
    $data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
    */
    function generate($template_view, $data = null)
    {
        if (is_array($data)) {

            extract($data);
        }
        include 'application/views/' . $template_view;
    }
    function render($template_view, $data = null)
    {
        ob_start();
        $this->generate($template_view,$data);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
