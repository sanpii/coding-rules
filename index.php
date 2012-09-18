<?php

function main()
{
    (new Application())->run();
}

class Application
{
    private $query;
    private $rules;

    public function __construct()
    {
        $this->query = $_GET['q'] ? $_GET['q'] : '';
        $this->rules = $this->loadRules();
    }

    private function loadRules()
    {
        $rules = [];
        foreach (glob('rules/*.rule') as $filename) {
            $rules[] = Rule::newFromFile($filename);
        }
        return $rules;
    }

    public function run()
    {
        $this->filterRules($this->rules);

        $this->render([
            'rules' => $this->rules,
            'summary' => $this->getSummary(),
            'query' => $this->query,
        ]);
    }

    private function filterRules(&$rules)
    {
        if (!empty($this->query)) {
            $rules = array_filter($rules, function($rule) {
                return (stristr($rule->title, $this->query) !== false);
            });
        }
    }

    private function getSummary()
    {
        static $titles = [
            'C' => 'Commentaires',
            'E' => 'Environnement',
            'F' => 'Fonctions',
            'G' => 'Général',
            'N' => 'Noms',
            'T' => 'Tests',
            'V' => 'Gestionnaire de version',
        ];

        $summary = array_fill_keys($titles, []);
        foreach ($this->rules as $rule) {
            if (isset($titles[$rule->id{0}])) {
                $title = $titles[$rule->id{0}];
                $summary[$title][] = $rule;
            }
        }
        $this->sortSummary($summary);
        return $summary;
    }

    private function sortSummary(&$summary)
    {
        foreach ($summary as &$entries) {
            uasort($entries, function($a, $b) {
                return strnatcmp(
                    substr($a->id, 1),
                    substr($b->id, 1)
                );
            });
        }
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
