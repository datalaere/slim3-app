<?php

// Controller configuration

$container['HomeController'] = function ($c) {
    return new App\Http\Controllers\HomeController($c);
};

$container['AuthController'] = function ($c) {
    return new App\Http\Controllers\Auth\AuthController($c);
};
