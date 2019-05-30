<?php

namespace App\Http\Middleware;

use App\Services\Middleware;

class PersistingInputMiddleware extends Middleware {

    public function __invoke($req, $res, $next) {

        $this->c->view->getEnvironment()->addGlobal('input', $_SESSION['input']);
        $_SESSION['input'] = $req->getParams();

        return $next($req, $res);
    }

}
