<?php

namespace Sanpi\Coding;

class Rule
{
    public $id;
    public $title;
    public $description;

    static public function getAll($filter)
    {
        static $titles = array(
            'C' => 'Commentaires',
            'E' => 'Environnement',
            'F' => 'Fonctions',
            'G' => 'Général',
            'N' => 'Noms',
            'T' => 'Tests',
            'V' => 'Gestionnaire de version',
        );

        $rules = array();
        foreach (glob(__DIR__ . '/../../../rules/*.rule') as $filename) {
            $rule = self::newFromFile($filename);
            if (self::accept($filter, $rule)) {
                if (isset($titles[$rule->id{0}])) {
                    $title = $titles[$rule->id{0}];
                    $rules[$title][] = $rule;
                }
            }
        }

        return self::sort($rules);
    }

    static private function accept($filter, $rule)
    {
        return (empty($filter) || stristr($rule->title, $filter) !== false);
    }

    static private function sort($rules)
    {
        foreach ($rules as &$section) {
            uasort($section, function($a, $b) {
                return strnatcmp(
                    substr($a->id, 1),
                    substr($b->id, 1)
                );
            });
        }
        return $rules;
    }

    static private function newFromFile($filename)
    {
        $rule = new self();

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
        $parser = new \dflydev\markdown\MarkdownExtraParser();
        return $parser->transform($description);
    }
}
