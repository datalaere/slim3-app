<?php

$app->get('/test', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info('INFO', $args);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
})->setName('test');


$app->get('/home', 'HomeController:index')->setName('home');

