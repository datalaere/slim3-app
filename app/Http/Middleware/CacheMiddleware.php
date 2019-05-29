<?php

namespace App\Http\Middleware;

use App\Services\Middleware;
use Slim\Http\Response;
use Slim\Http\Headers;

class CacheMiddleware extends Middleware {

    public function __invoke($req, $res, $next) {

        if( !$this->c->get('settings')['cache']['enabled'] ) {
            return $next($req, $res);
        }

        $key = $req->getUri()->getPath();

        $this->c->cache->add($key, $res->getBody()->__toString());

        return $next($req, $res);

      }
}
