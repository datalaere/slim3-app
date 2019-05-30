<?php

namespace App\Http\Middleware;

use App\Services\Middleware;

class ValidationErrorsMiddleware extends Middleware {

    public function __invoke($req, $res, $next) {

        $this->c->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        unset($_SESSION['errors']);

        return $next($req, $res);
    }

}
