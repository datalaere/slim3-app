<?php
return [
    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. 
    | The usual view path has already been registered for you.
    |
    */
    'path' => $root_dir . '/resources/views/',
    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */
    'compiled' => $_ENV['APP_ENV'] ?: $root_dir . '/storage/views/',
];
