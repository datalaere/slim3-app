<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
foreach (glob($webroot_dir . '/routes/*.php') as $route) {
    require $route;
}