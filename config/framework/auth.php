<?php

// Config Auth
$container['auth'] = function ($c) {
    return new App\Services\Auth;
};
