<?php

namespace Controllers;

use Core\Controller;

class HomeController extends Controller {
    public function index() {
        
        require_once __DIR__ . '/../views/home/index.php';
    }
}