<?php

return [
    'settings' => [
        'displayErrorDetails' => false, // set to false in production
        'addContentLengthHeader' => true, // Allow the web server to send the content-length header
        'routerCacheFile' => $root_dir . '/storage/routes/cache',
        // Renderer settings
        'renderer' => [
            'debug' => false,
            'template_path' => $root_dir . '/resources/views/',
            'cache_path' => $root_dir . '/storage/views/',
        ],
        'cache' => [
            'cache_path' => $root_dir . '/storage/cache/',
            'enabled' => true,
        ],
        // Monolog settings
        'logger' => [
            'name' => $_ENV['APP_NAME'] ?: 'Slim 3 App',
            'path' => $root_dir . '/storage/logs/error.log',
            'level' => \Monolog\Logger::EMERGENCY,
        ],
        'mail' => [
            'host'      => '',  // SMTP Host
            'port'      => '',  // SMTP Port
            'username'  => '',  // SMTP Username
            'password'  => '',  // SMTP Password
            'protocol'  => '',   // SSL or TLS
            'default'   => ['email' => 'no-reply@mail.com', 'from' => 'Webmaster'],
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
