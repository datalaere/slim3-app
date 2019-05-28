<?php

// Twig view renderer
$container['view'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    $view = new Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache_path'],
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $c->request->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension(
            $c->router, $basePath
    ));

    if( !empty($_ENV['DB_DRIVER']) ) {
        $view->getEnvironment()->addGlobal('auth', [
            'check' => $c->auth->check(),
            'user' => $c->auth->user()
        ]);
    }

    $view->getEnvironment()->addGlobal('flash', $c->flash);

    return $view;
};
