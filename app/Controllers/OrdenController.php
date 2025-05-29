<?php

namespace Controllers;

use Core\Controller;
use Models\Orden;
class OrdenController extends Controller { 
    private $model;

    public function __construct() {
        $this->model = new Orden();
    }
    public function index() {
        $pagina = $_GET['pagina'] ?? 1;
        $porPagina = $_GET['por_pagina'] ?? 100;
        $busqueda = $_GET['busqueda'] ?? '';
        
        $ordenes = $this->model->getOrdenes($pagina, $porPagina, $busqueda);
        $totalordenes = $this->model->getTotalOrdenes($busqueda);
        $totalPaginas = ceil($totalordenes / $porPagina);
        
        $data = [
            'ordenes' => $ordenes,
            'paginaActual' => $pagina,
            'totalPaginas' => $totalPaginas,
            'porPagina' => $porPagina,
            'busqueda' => $busqueda,
            'totalordenes' => $totalordenes
        ];
        require_once __DIR__ . '/../views/ordenes/index.php';
    }
    public function exportExcel() {
        $Ordenes = $this->model->exportToExcel();
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Ordenes.xls"');
        header('Cache-Control: max-age=0');
        
        $output = fopen('php://output', 'w');
        
        // Encabezados
        fputcsv($output, array('ID', 'Código', 'Nombre', 'Teléfono', 'Correo'), "\t");
        
        // Datos
        foreach ($Ordenes as $cliente) {
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