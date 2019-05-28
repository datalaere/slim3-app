<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Auth;

use App\Services\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{

    // Logout
    public function getLogout($req, $res, $args)
    {
        $this->flash->addMessage('info', 'You have been logged out!');
        $this->auth->logout();
        return $res->withRedirect($this->router->pathFor('home'));
    }

    // Login
    public function getLogin($req, $res, $args)
    {
        return $this->view->render($res, 'auth/login.twig');
    }

    public function postLogin($req, $res, $args)
    {
        $auth = $this->auth->attempt(
            $req->getParam('email'),
            $req->getParam('password')
        );

        if (!$auth) {
            $this->flash->addMessage('error', 'Wrong credentials!');
            return $res->withRedirect($this->router->pathFor('auth.login'));
        }

        $this->flash->addMessage('info', 'You have logged in successfully!');
        return $res->withRedirect($this->router->pathFor('home'));
    }

    // Register
    public function getRegister($req, $res, $args)
    {
        return $this->view->render($res, 'auth/register.twig');
    }

    public function postRegister($req, $res, $args)
    {
        $v = $this->validator->validate($req, [
            'email' => v::noWhitespace()->notEmpty()->email()->emailExists(),
            'name' => v::notEmpty(),
            'password' => v::noWhitespace()->notEmpty()->alpha(),
        ]);

        if ($v->failed()) {
            return $res->withRedirect($this->router->pathFor('auth.register'));
        }

        $user = User::create([
                    'email' => $req->getParam('email'),
                    'name' => $req->getParam('name'),
        ]);

        $user->setPassword($req->getParam('password'));

        $this->flash->addMessage('info', 'You have been signed up!');

        $this->auth->attempt($req->getParam('email'), $req->getParam('password'));

        return $res->withRedirect($this->router->pathFor('home'));
    }

    // Password change
    public function getChangePassword($req, $res, $args)
    {
        return $this->view->render($res, 'auth/password/change.twig');
    }

    public function postChangePassword($req, $res, $args)
    {
        $v = $this->validator->validate($req, [
            'password_old' => v::noWhitespace()
                    ->notEmpty()
                    ->matchesPassword($this->auth->user()->password),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($v->failed()) {
            return $res->withRedirect($this->router->pathFor('auth.register'));
        }

        $this->auth->user()->setPassword($req->getParam('password'));


        $this->flash->addMessage('info', 'Your password has been changed!');

        return $res->withRedirect($this->router->pathFor('home'));
    }
}
