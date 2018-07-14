<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$app->get('/test', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info('INFO', $args);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
})->setName('test');
