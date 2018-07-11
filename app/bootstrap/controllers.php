<?php

// Controller configuration

$container['HomeController'] = function ($c) {
    return new App\Controllers\HomeController($c);
};
