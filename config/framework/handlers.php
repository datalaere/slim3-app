<?php

if($_ENV['APP_ENV'] == 'production') {
    $container['phpErrorHandler'] = function ($c) {
        return new App\Handlers\ErrorHandler($c);
    };
}

