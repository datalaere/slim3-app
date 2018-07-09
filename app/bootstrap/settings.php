<?php

return [
    'settings' => [
        'displayErrorDetails' => APP_ERROR, // set to false in production
        'addContentLengthHeader' => APP_HEADER, // Allow the web server to send the content-length header
// Renderer settings
        'renderer' => [
            'template_path' => $webroot_dir . 'app/resources/views/',
            'cache_path' => APP_CACHE,
        ],
        // Monolog settings
        'logger' => [
            'name' => APP_NAME,
            'path' => $webroot_dir . 'app/storage/logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
