<?php

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the Router within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$app->get('/', 'HomeController:index')->setName('home');


$app->group('', function() {
// Register
    $this->get('/auth/register', 'AuthController:getRegister')->setName('auth.register');

    $this->post('/auth/register', 'AuthController:postRegister');

// Login
    $this->get('/auth/login', 'AuthController:getLogin')->setName('auth.login');

    $this->post('/auth/login', 'AuthController:postLogin');
})->add(new GuestMiddleware($container));



$app->group('', function() {

    // Password change
    $this->get('/auth/password/change', 'AuthController:getChangePassword')->setName('auth.password.change');

    $this->post('/auth/password/change', 'AuthController:postChangePassword');

    // Logout
    $this->get('/auth/logout', 'AuthController:getLogout')->setName('auth.logout');
})->add(new AuthMiddleware($container));


$app->get('/log', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info('INFO', $args);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
})->setName('test');


$app->get('/mail', function ($request, $response, $args) {
    $user = new stdClass;
    $user->name = 'John Doe';
    $user->email = 'johndoe@mail.com';
    
    $this->mailer->setTo($user->email, $user->name)->sendMessage(new App\Mail\WelcomeMailable($user));
     
    $response->getBody()->write('Mail sent!');
    
    return $response;
});
