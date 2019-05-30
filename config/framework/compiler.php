<?php
/*
 * Compiler 
 */

$compiledPath = $root_dir . '/bootstrap/cache/compiled.php';

if(!file_exists($compiledPath)){
    $src = $root_dir . '/config/framework/';
    $routes = $root_dir . '/routes/';
    $files = array(
        $src. 'app.php',
        $src. 'session.php',
        $src .'view.php',
        $src .'database.php', 
        $src .'validation.php',
        $src .'logger.php',
        $src .'handlers.php',
        $src .'cache.php',
        $src .'auth.php',
        $src .'csrf.php',
        $src .'flash.php',
        $src .'mail.php',
        $src .'middleware.php',
        $src .'controllers.php',
        $routes .'api.php',
        $routes .'web.php',
        );

    file_put_contents($compiledPath, '<?php');

    foreach($files as $file) {
        $content = file_get_contents($file);
        $compiled = preg_replace('/^<\?php(.*)(\?>)?$/s', '$1', $content);

        file_put_contents($compiledPath, $compiled, FILE_APPEND);
    }
}
