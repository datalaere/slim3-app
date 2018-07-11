<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use Slim\Views\Twig as View;

class HomeController extends Controller {

    public function __invoke($req, $res, $args) {

        $response = $next($request, $response);
        return $response;
    }

    public function index($req, $res, $args) {


        //$user = $this->db->table('users')->find(1);

        return $this->view->render($res, 'home.twig');
    }

}
