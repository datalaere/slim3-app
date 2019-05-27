<?php

// Auth
$container['auth'] = function ($c) {
    return new App\Auth\Auth;
};


// Flash messages
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages();
};

// CSRF
$container['csrf'] = function ($c) {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($req, $res, $next) {
        $req = $req->withAttribute("csrf_status", false);
        return $next($req, $res);
    });
    return $guard;
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
$settings = $container->get('settings')['db'];
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($settings);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container['db'] = function ($c) use ($capsule) {
    return $capsule;
};

// validation
use Respect\Validation\Validator as v;

$container['validator'] = function ($c) {
    return new App\Validation\Validator;
};
v::with('App\\Validation\\Rules\\');

