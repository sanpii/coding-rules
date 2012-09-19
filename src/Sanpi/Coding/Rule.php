<?php

namespace Sanpi\Coding;

class Rule
{
    public $id;
    public $title;
    public $description;

    static public function getAll($filter)
    {
        $rules = array();
        foreach (glob(__DIR__ . '/Resources/rules/*') as $section) {
            if (is_dir($section)) {
                foreach (glob("$section/*.rule") as $filename) {
                    $rule = self::newFromFile($filename);
                    if (self::accept($rule, $filter)) {
                        $title = basename($section);
                        $rules[$title][] = $rule;
                    }
                }
            }
        }

        return $rules;
    }

    static private function accept($rule, $filter)
    {
        return (empty($filter) || stristr($rule->title, $filter) !== false);
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
        preg_match('#/(\w\d{1,2}).rule#', $filename, $matches);
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
