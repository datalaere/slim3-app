<?php

// Config CSRF
$container['csrf'] = function ($c) {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($req, $res, $next) {
        $req = $req->withAttribute("csrf_status", false);
        return $next($req, $res);
    });
    return $guard;
};
