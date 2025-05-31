<?php

namespace Core;
class App {
    protected $currentController = 'HomeController';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();

        // Buscar controlador en controllers folder
        if (isset($url[0]) && file_exists('../app/Controllers/' . ucwords($url[0]) . 'Controller.php')) {
            $this->currentController = ucwords($url[0]) . 'Controller';
            unset($url[0]);
        }

        // Requerir el controlador
        require_once '../app/Controllers/' . $this->currentController . '.php';
        $this->currentController = "Controllers\\" . $this->currentController; // Añadir namespace
        $this->currentController = new $this->currentController;

        // Verificar el método (segunda parte de la URL)
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // Obtener parámetros
        $this->params = $url ? array_values($url) : [];

        // Llamar al método del controlador con los parámetros
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
} 