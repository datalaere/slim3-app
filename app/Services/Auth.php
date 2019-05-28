<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use App\Models\User;

class Auth {

    public function user() {
        return User::find($_SESSION['user']);
    }

    public function check() {
        return isset($_SESSION['user']);
    }

    public function attempt($email, $password) {

        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
    }

    public function logout() {
        unset($_SESSION['user']);
    }

}
