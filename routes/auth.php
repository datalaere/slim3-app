<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;

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

