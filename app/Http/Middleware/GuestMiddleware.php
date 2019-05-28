<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use App\Services\Middleware;

class GuestMiddleware extends Middleware {

    public function __invoke($req, $res, $next) {

        if ($this->auth->check()) {
            return $res->withRedirect($this->router->pathFor('home'));
        }

        return $next($req, $res);
    }

}
