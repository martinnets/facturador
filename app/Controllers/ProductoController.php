<?php

namespace Controllers;

use Core\Controller;
use Models\Producto;
class ProductoController extends Controller { 
    private $model;

    public function __construct() {
        $this->model = new Producto();
    }
    public function index() {
        $pagina = $_GET['pagina'] ?? 1;
        $porPagina = $_GET['por_pagina'] ?? 10;
        $busqueda = $_GET['busqueda'] ?? '';
        
        $productos = $this->model->getproductos($pagina, $porPagina, $busqueda);
        $totalproductos = $this->model->getTotalproductos($busqueda);
        $totalPaginas = ceil($totalproductos / $porPagina);
        
        $data = [
            'productos' => $productos,
            'paginaActual' => $pagina,
            'totalPaginas' => $totalPaginas,
            'porPagina' => $porPagina,
            'busqueda' => $busqueda,
            'totalproductos' => $totalproductos
        ];
        require_once __DIR__ . '/../views/productos/index.php';
    }
    public function exportExcel() {
        $productos = $this->model->exportToExcel();
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="productos.xls"');
        header('Cache-Control: max-age=0');
        
        $output = fopen('php://output', 'w');
        
        // Encabezados
        fputcsv($output, array('id_producto', 'codigo', 'producto', 'cod_proveedor'), "\t");
        
        // Datos
        foreach ($productos as $cliente) {
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