<?php

// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// optional php view renderer
$container['view'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    $view = new Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache_path'],
    ]);

    $view->addExtension(new Slim\Views\TwigExtension(
            $c->router, $c->request->getUri()
    ));

    return $view;
};


$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// db
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};
