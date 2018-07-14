<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

class Controller {

    protected $c;

    function __construct($container) {
        $this->c = $container;
    }

    public function __get($property) {
        if ($this->c->{$property}) {
            return $this->c->{$property};
        }
    }

}
