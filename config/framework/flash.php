<?php

// Config flash messages
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages();
};
