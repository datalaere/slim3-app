<?php

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info('INFO', $args);

    // Render index view
    return $this->view->render($response, 'home.twig', $args);
});
