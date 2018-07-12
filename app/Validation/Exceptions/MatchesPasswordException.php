<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class EmailExistsException extends ValidationException {

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Password does not match.',
        ]
    ];

    public function validate($input) {
        return false;
    }

}
