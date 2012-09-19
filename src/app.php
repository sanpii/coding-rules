<?php

use Silex\Application;
use Sanpi\Coding\Rule;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();

$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/Sanpi/Coding/Resources/views',
));

$app->get('/', function(Request $request) use($app) {
    $query = $request->get('q');
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
