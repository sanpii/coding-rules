<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Sanpi\Coding\Rule;

$app = new Application();

$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

$app['debug'] = true;

$app->get('/', function() use($app) {
    $query = isset($_GET['q']) ? $_GET['q'] : '';

    return $app['twig']->render('layout.html.twig', [
        'sections' => Rule::getAll($query),
        'query' => $query,
    ]);
});

$app->run();
