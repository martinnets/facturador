<?php

namespace Controllers;
use Core\Controller;
class HomeController extends Controller {
 
    public function index() {
         require_once __DIR__ . '../../../App/views/home/index.php';
    }
}