<?php

namespace App\Http\Middleware;

use App\Services\Middleware;

class CsrfMiddleware extends Middleware {

    public function __invoke($req, $res, $next) {

        $keyPair = $this->c->csrf->generateToken();

        $this->c->view->getEnvironment()->addGlobal('csrf', [
            'field' =>
            '<input type="hidden" name="' . $this->c->csrf->getTokenNameKey() . '" value="' . $keyPair['csrf_name'] . '">'
            . '<input type="hidden" name="' . $this->c->csrf->getTokenValueKey() . '" value="' . $keyPair['csrf_value'] . '">
            ']);

        return $next($req, $res);
    }

}
