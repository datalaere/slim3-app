<?php

// Config validation
use Respect\Validation\Validator as v;

$container['validator'] = function ($c) {
    return new App\Validation\Validator;
};

v::with('App\\Validation\\Rules\\');

