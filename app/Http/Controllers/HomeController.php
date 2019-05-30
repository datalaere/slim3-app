<?php

namespace App\Http\Controllers;

use App\Services\Controller;

class HomeController extends Controller {

    public function index($req, $res, $args) {
        return $this->view->render($res, 'home.twig');
    }

}
