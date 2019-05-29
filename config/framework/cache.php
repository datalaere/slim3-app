<?php

$container['cache'] = function ($c) {
    $settings = $c->get('settings')['cache']['cache_path'];
    $slim = new \Slim\App($c);
    $cache = new \SNicholson\SlimFileCache\Cache($slim, $settings);
    return $cache;
};
