<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Sanpi\Coding\Rule;

$app = new Application();

$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/Sanpi/Coding/Resources/views',
));

$app->get('/', function() use($app) {
    $query = isset($_GET['q']) ? $_GET['q'] : '';

    return $app['twig']->render('layout.html.twig', array(
        'sections' => Rule::getAll($query),
        'query' => $query,
    ));
});

$app->get('/json/{query}', function($query) use($app) {
    return $app->json(
        Rule::getAll($query)
    );
})->value('query', '');

return $app;
