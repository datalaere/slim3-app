<?php

// Config DB

if( !empty($_ENV['DB_DRIVER']) ) {

    $settings = $container->get('settings')['connections'][$_ENV['DB_DRIVER']];

    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    $container['db'] = function ($c) use ($capsule) {
        return $capsule;
    };

}
