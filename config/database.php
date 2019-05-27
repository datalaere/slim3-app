<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */
    'default' => $_ENV['DB_CONNECTION'] ?: 'mysql',
    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by PHP is shown below to make development simple.
    |
    |
    | All database work in PHP is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */
    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => $_ENV['DATABASE_URL'],
            'database' => $_ENV['DATABASE'],
            'prefix' => $_ENV['DB_PREFIX'] ?: '',
            'foreign_key_constraints' => $_ENV['DB_FOREIGN_KEYS'] ?: true,
        ],
        'mysql' => [
            'driver' => 'mysql',
            'url' => $_ENV['DATABASE_URL'],
            'host' => $_ENV['DB_HOST'] ?: '127.0.0.1',
            'port' => $_ENV['DB_PORT'] ?: '3306',
            'name' => $_ENV['DB_NAME'] ?: '',
            'username' => $_ENV['DB_USERNAME'] ?: '',
            'password' => $_ENV['DB_PASSWORD'] ?: '',
            'unix_socket' => $_ENV['DB_SOCKET'] ?: '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => $_ENV['DB_PREFIX'] ?: '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        'pgsql' => [
            'driver' => 'pgsql',
            'url' => $_ENV['DATABASE_URL'],
            'host' =>$_ENV['DB_HOST'] ?: '127.0.0.1',
            'port' => $_ENV['DB_PORT'] ?: '5432',
            'name' => $_ENV['DB_NAME'] ?: '',
            'username' => $_ENV['DB_USERNAME'] ?: '',
            'password' => $_ENV['DB_PASSWORD'] ?: '',
            'charset' => 'utf8',
            'prefix' => $_ENV['DB_PREFIX'] ?: '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => $_ENV['DATABASE_URL'],
            'host' => $_ENV['DB_HOST'] ?: 'localhost',
            'port' => $_ENV['DB_PORT'] ?: '1433',
            'name' => $_ENV['DB_NAME'] ?: '',
            'username' => $_ENV['DB_USERNAME'] ?: '',
            'password' => $_ENV['DB_PASSWORD'] ?: '',
            'charset' => 'utf8',
            'prefix' => $_ENV['DB_PREFIX'] ?: '',
            'prefix_indexes' => true,
        ],
    ],
    
];
