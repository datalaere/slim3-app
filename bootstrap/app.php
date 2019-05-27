<?php

/*
|--------------------------------------------------------------------------
| Get settings
|--------------------------------------------------------------------------
|
| Before we can do anything we need settings for setting the application.
|
*/

if (file_exists($root_dir . '/env.ini')) {
    $_ENV = parse_ini_file($root_dir . '/env.ini');
    $settings = require $root_dir . '/config/' . $_ENV['APP_ENV'] . '.php';
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new application instance
| which serves as the "glue" for all the components, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new \Slim\App($settings);
$container = $app->getContainer();

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed.
|
*/

// Twig view renderer
$container['view'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    $view = new Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache_path'],
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $c->request->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension(
            $c->router, $basePath
    ));

    $view->getEnvironment()->addGlobal('auth', [
        'check' => $c->auth->check(),
        'user' => $c->auth->user()
    ]);

    $view->getEnvironment()->addGlobal('flash', $c->flash);

    return $view;
};

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| To actually show something we have to include our routes into the system.
|
*/

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
