<?php

namespace Controllers;

use Core\Controller;
use Models\Cliente;
class ClienteController extends Controller { 
    private $model;

    public function __construct() {
        $this->model = new Cliente();
    }
    public function index() {
        $pagina = $_GET['pagina'] ?? 1;
        $porPagina = $_GET['por_pagina'] ?? 10;
        $busqueda = $_GET['busqueda'] ?? '';
        
        $clientes = $this->model->getClientes($pagina, $porPagina, $busqueda);
        $totalClientes = $this->model->getTotalClientes($busqueda);
        $totalPaginas = ceil($totalClientes / $porPagina);
        
        $data = [
            'clientes' => $clientes,
            'paginaActual' => $pagina,
            'totalPaginas' => $totalPaginas,
            'porPagina' => $porPagina,
            'busqueda' => $busqueda,
            'totalClientes' => $totalClientes
        ];
        
        require_once __DIR__ . '/../views/clientes/index.php';
        // $title = "Clientes";
        // $clientes = $this->model->readAll();
        // $viewFile = __DIR__ . '../../Views/clientes/index.php';
        // error_log("Ruta de la vista: " . $viewFile); // Para depuración
        // if(file_exists($viewFile)) {
        //     //require_once $viewFile;
        //     include $viewFile;
            
        // } else {
        //     die('La vista no existe');
        // }
        
    }
    public function exportExcel() {
        $clientes = $this->model->exportToExcel();
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="clientes.xls"');
        header('Cache-Control: max-age=0');
        
        $output = fopen('php://output', 'w');
        
        // Encabezados
        fputcsv($output, array('ID', 'Código', 'Nombre', 'Teléfono', 'Correo'), "\t");
        
        // Datos
        foreach ($clientes as $cliente) {
            fputcsv($output, $cliente, "\t");
        }
        
        fclose($output);
        exit;
    }
    private function loadView($view, $data = []) {
        // Extraer los datos del array para que sean variables accesibles en la vista
        extract($data);
        
        // Ruta al archivo de vista
        $viewFile = 'Views/' . $view . '.php';
        
        if(file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die('La vista no existe');
        }
    }
    // public function create() { ... }
    // public function store() { ... }
    // public function edit($id) { ... }
    // public function update($id) { ... }
    // public function delete($id) { ... }
}