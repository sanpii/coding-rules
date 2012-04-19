<?php

function main()
{
    (new Application())->run();
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
            $rules[] = Rule::newFromFile($filename);
        }
        return $rules;
    }

    public function run()
    {
        $this->render(array(
            'rules' => $this->rules,
            'summary' => $this->getSummary(),
        ));
    }

    private function getSummary()
    {
        static $titles = array(
            'C' => 'Commentaires',
            'E' => 'Environnement',
            'F' => 'Fontions',
            'G' => 'Général',
            'N' => 'Noms',
            'T' => 'Tests',
        );

        $summary = array();
        foreach ($this->rules as $rule) {
            $title = $titles[$rule->id{0}];
            $summary[$title][] = $rule;
        }
        return $summary;
    }

    private function render($params)
    {
        extract($params);
        ob_start();
        require 'layout.tpl';
        $content = ob_get_contents();
        ob_end_clean();

        print $content;
    }
}

class Rule
{
    public $id;
    public $title;
    public $description;

    static public function newFromFile($filename)
    {
        $rule = new Rule();

        $content = file_get_contents($filename);
        $rule->id = $rule->getId($filename);
        $rule->title = $rule->getTitle($content);
        $rule->description = $rule->getDescription($content);

        return $rule;
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
        require_once 'vendor/php-markdown/markdown.php';

        return Markdown($description);
    }
}

main();

