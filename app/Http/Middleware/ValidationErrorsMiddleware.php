<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use App\Services\Middleware;

class ValidationErrorsMiddleware extends Middleware {

    public function __invoke($req, $res, $next) {

        $this->c->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        unset($_SESSION['errors']);

        return $next($req, $res);
    }

}
