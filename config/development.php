<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings
        'renderer' => [
            'template_path' => $root_dir . '/resources/views/',
            'cache_path' => false,
        ],
        // Monolog settings
        'logger' => [
            'name' => 'Slim 3 App',
            'path' => $root_dir . '/storage/logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'driver' => '',
            'host' => '',
            'database' => '',
            'username' => '',
            'password' => '',
            'charset' => '',
            'collation' => '',
            'prefix' => '',
        ],
    ],
];
