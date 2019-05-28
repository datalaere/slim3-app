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
            'name' => $_ENV['APP_NAME'] ?: 'Slim 3 App',
            'path' => $root_dir . '/storage/logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
       'connections' => [
            'mysql' => [
                'driver'    => $_ENV['DB_DRIVER'] ?: 'mysql',
                'host'      => $_ENV['DB_DRIVER'] ?: 'localhost',
                'database'  => $_ENV['DB_NAME'] ?: 'database',
                'username'  => $_ENV['DB_USER'] ?: 'root',
                'password'  => $_ENV['DB_PASS'] ?: 'mysql',
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => $_ENV['DB_PREFIX'] ?: '',
                'strict'    => false,
            ],
        ],
    ],
];

