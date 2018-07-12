<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Middleware;

class AuthMiddleware extends Middleware {

    public function __invoke($req, $res, $next) {

        if (!$this->auth->check()) {
            $this->flash->addMessage('error', 'Please sign in!');
            return $res->withRedirect($this->router->pathFor('auth.login'));
        }

        return $next($req, $res);
    }

}
