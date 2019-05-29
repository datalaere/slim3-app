<?php

// Application middleware

$app->add(new App\Http\Middleware\CacheMiddleware($container));

$app->add(new App\Http\Middleware\ValidationErrorsMiddleware($container));

$app->add(new App\Http\Middleware\PersistingInputMiddleware($container));

$app->add($container->csrf);

