<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';
    protected $fillable = [
        'email',
        'name',
        'password',
    ];

    public function setPassword($password) {
        return $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

}
