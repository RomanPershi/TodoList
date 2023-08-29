<?php
class TemplateModifier {
    private $template;

    public function __construct($template) {
        $this->template = $template;
    }

    public function insertCode($code, $placeholder) {
        $modifiedTemplate = str_replace($placeholder, $code, $this->template);
        return $modifiedTemplate;
    }
}
