<?php

/*
|--------------------------------------------------------------------------
| Config settings
|--------------------------------------------------------------------------
|
| Before we can do anything we need settings for setting the application.
|
*/

if (file_exists($root_dir . '/env.ini')) {
    $_ENV = parse_ini_file($root_dir . '/env.ini');
    $settings = require $root_dir . '/config/environments/' . $_ENV['APP_ENV'] . '.php';
}

/*
  |--------------------------------------------------------------------------
  | Include The Compiled File
  |--------------------------------------------------------------------------
  |
  | To dramatically increase your application's performance, you may use a
  | compiled file which contains all of the commonly used bootstrap files
  | by request.
  |
*/

if ($_ENV['APP_ENV'] == 'production' && file_exists($root_dir . '/bootstrap/cache/compiled.php')) {
    return require $root_dir .'/bootstrap/cache/compiled.php';
} elseif($_ENV['APP_ENV'] == 'production' && !file_exists($root_dir . '/bootstrap/cache/compiled.php')) {
    require $root_dir . '/config/framework/compiler.php';
} elseif($_ENV['APP_ENV'] == 'development' && file_exists($root_dir . '/bootstrap/cache/compiled.php')) {
    unlink($root_dir . '/bootstrap/cache/compiled.php');
}

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed.
|
*/

require $root_dir . '/config/framework/app.php';
require $root_dir . '/config/framework/session.php';
require $root_dir . '/config/framework/view.php';
require $root_dir . '/config/framework/cache.php';
require $root_dir . '/config/framework/database.php';
require $root_dir . '/config/framework/validation.php';
require $root_dir . '/config/framework/logger.php';
require $root_dir . '/config/framework/handlers.php';
require $root_dir . '/config/framework/auth.php';
require $root_dir . '/config/framework/csrf.php';
require $root_dir . '/config/framework/flash.php';

/*
|--------------------------------------------------------------------------
| Routes, Controllers and Middleware
|--------------------------------------------------------------------------
|
| To actually show something we have to include our routes into the system.
|
*/

use Slim\Http\Request;
use Slim\Http\Response;

require $root_dir . '/config/framework/middleware.php';
require $root_dir . '/config/framework/controllers.php';

require $root_dir . '/routes/web.php';
require $root_dir . '/routes/api.php';

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
