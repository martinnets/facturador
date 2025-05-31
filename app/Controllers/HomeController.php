<?php

namespace Controllers;
use Core\Controller;
class HomeController extends Controller {
 
    public function index() {
         require_once    '../app/Views/home/index.php';
    }
}