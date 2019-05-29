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

        if( $this->cache->get($key) ) {
            $body = $this->cache->get($key);

            $headers = new Headers;
            foreach ($res->getHeaders() as $header => $value) {
                $headers->set($header, $value);
            }

            return (
                new Response($res->getStatusCode(), $headers)
            )->write($body);
        }

        $response = $next($req, $res);

        if( $response->isOk() ) {
            $this->cache->add($key, $response->getBody()->__toString());
        }

        return $response;

      }
}
