<?php

namespace App\Http\Middleware;

use App\Services\Middleware;

class AuthMiddleware extends Middleware {

    public function __invoke($req, $res, $next) {

        if (!$this->auth->check()) {
            $this->flash->addMessage('error', 'Please sign in!');
            return $res->withRedirect($this->router->pathFor('auth.login'));
        }

        return $next($req, $res);
    }

}
