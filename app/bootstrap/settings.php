<?php

return [
    'settings' => [
        'displayErrorDetails' => APP_ERROR, // set to false in production
        'addContentLengthHeader' => APP_HEADER, // Allow the web server to send the content-length header
// Renderer settings
        'renderer' => [
            'template_path' => $webroot_dir . 'app/resources/views/',
        ],
        // Monolog settings
        'logger' => [
            'name' => APP_NAME,
            'path' => isset($_ENV['docker']) ? 'php://stdout' : $webroot_dir . 'app/storage/logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
