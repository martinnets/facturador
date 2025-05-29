<?php

namespace Core;

class Controller {
    // Cargar modelo
    public function model($model) {
        require_once '../app/Models/' . $model . '.php';
        $modelClass = "Models\\" . $model; // Añadir namespace
        return new $modelClass();
    }

    // Cargar vista
    public function view($view,$data=[] ,$title='') {
        // Extraer datos para que estén disponibles en la vista
        //

        if (file_exists('../app/Views/' . $view . '.php')) {
            ob_start();
            require_once '../app/Views/' . $view . '.php';
            extract($data);
            $data = ob_get_clean(); // Captura el contenido de la vista específica
            require_once '../app/Views/layouts/main.php'; // Carga el layout principal y pasa el contenido
        } else {
            die('La vista no existe: ' . $view);
        }
    }
}