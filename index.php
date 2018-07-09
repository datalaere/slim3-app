<?php

session_start();

/** @var string Directory containing all of the site's files */
$root_dir = dirname(__FILE__);

/** @var string Document Root */
$webroot_dir = $root_dir . '/';


/**
 * Load Composer autoload
 */
require $webroot_dir . 'vendor/autoload.php';

/**
 * Expose global env() function from oscarotero/env
 */
Env::init();

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
if (file_exists($webroot_dir . 'app/.env')) {
    $dotenv = new Dotenv\Dotenv($webroot_dir . 'app/');
    $dotenv->load();
    $dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'APP_HOME', 'APP_SITEURL']);
}

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define('APP_ENV', env('APP_ENV') ?: 'production');

define('APP_NAME', env('APP_NAME') ?: 'APP');

$env_config = $webroot_dir . 'app/config/environments/' . APP_ENV . '.php';

if (file_exists($env_config)) {
    require_once $env_config;
}

/**
 * URLs
 */
define('APP_HOME', env('APP_HOME'));
define('APP_SITEURL', env('APP_SITEURL'));

/**
 * Custom Content Directory
 */
define('APP_SRC', $webroot_dir . 'app/bootstrap/');
define('APP_VIEWS', $webroot_dir . 'app/resources/views/');
define('CONTENT_DIR', '/public/');
define('APP_CONTENT_DIR', $webroot_dir . 'public/');
define('APP_CONTENT_URL', APP_HOME . CONTENT_DIR);

/**
 * DB settings
 */
define('DB_NAME', env('DB_NAME'));
define('DB_USER', env('DB_USER'));
define('DB_PASSWORD', env('DB_PASSWORD'));
define('DB_HOST', env('DB_HOST') ?: 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
define('DB_PREFIX', env('DB_PREFIX') ?: '');

/**
 * Authentication Unique Keys and Salts
 */
// Instantiate the app
$settings = require APP_SRC . 'settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require APP_SRC . 'dependencies.php';

// Register middleware
require APP_SRC . 'middleware.php';

// Register routes
require APP_SRC . 'routes.php';

// Run app
$app->run();
