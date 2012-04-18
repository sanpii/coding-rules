<?php

class Rule
{
    public $id;
    public $title;
    public $description;

    public function __construct($filename)
    {
        $content = file_get_contents($filename);

        $this->id = $this->getId($filename);
        $this->title = $this->getTitle($content);
        $this->description = $this->getDescription($content);
    }

    private function getId($filename)
    {
        preg_match('#rules/(\w\d{1,2}).rule#', $filename, $matches);
        return array_pop($matches);
    }

    private function getTitle($content)
    {
        preg_match('#^== (.*) ==#', $content, $matches);
        return array_pop($matches);
    }

    private function getDescription($content)
    {
        $description = preg_replace('#^== .* ==#', '', $content);
        return $this->parseMarkdown($description);
    }

    private function parseMarkdown($description)
    {
        require_once 'markdown.php';
        return Markdown($description);
    }
}

class Application
{
    private $rules;

    public function __construct()
    {
        $this->rules = $this->loadRules();
    }

    private function loadRules()
    {
        $rules = array();
        foreach (glob('rules/*.rule') as $filename) {
            $rules[] = new Rule($filename);
        }
        return $rules;
    }

    public function run()
    {
        $this->render($this->rules);
    }

    public function render($rules)
    {
        extract((array)$rules);
        ob_start();
        include(__DIR__ . '/layout.tpl');
        $content = ob_get_contents();
        ob_end_clean();

        print $content;
    }
}

(new Application())->run();

