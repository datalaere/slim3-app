<?php

namespace App\Handlers;

use App\Services\Handler;
use Monolog\Logger;

class ErrorHandler extends Handler {

    public function __invoke($req, $res, $exception) {
          /** @var \Monolog\Logger $monoLog */
        $monoLog = $this->c->logger;
        $monoLog->addError($exception->getMessage());
        $monoLog->addError($exception->getTraceAsString());
        $monoLog->addError($exception->getFile());
        $monoLog->addError($exception->getCode());
        $monoLog->addError($exception->getLine());

        $res->getBody()->rewind();

        return $res->withStatus(500)
                    ->withHeader('Content-Type', 'text/html')
                    ->write("An error has occurred. Error details will be present within the application log. Please contact your website administrator.");
    }
    
}
