<?php

/** @var string Directory containing all of the site's files */
$root_dir = dirname(__DIR__);

/** @var string Document Root */
$webroot_dir = $root_dir . '/public/';

/**
 * Load Composer autoload
 */
require $root_dir . '/vendor/autoload.php';

/**
 * Load App
 */
require $root_dir . '/bootstrap/app.php';

/**
 * Run App
 */
$app->run();

/**
 * Run Cache
 */

