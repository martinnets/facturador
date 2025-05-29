<?php

namespace Controllers;

use Core\Controller;

class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'Página de Inicio'
        ];
        $this->view('home/index', $data);
    }
}