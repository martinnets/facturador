<?php

namespace Controllers;

use Core\Controller;
use Models\Comprobante;
use Models\Orden;
class ComprobanteController extends Controller { 
    private $modelComprobante;
    private $modelOrden;
    public function __construct() {
        $this->modelComprobante = new Comprobante();
        $this->modelOrden = new Orden();
    }
    public function index() {
        $pagina = $_GET['pagina'] ?? 1;
        $porPagina = $_GET['por_pagina'] ?? 10;
        $busqueda = $_GET['busqueda'] ?? '';
        
        $comprobantes = $this->modelComprobante->getcomprobantes($pagina, $porPagina, $busqueda);
        $totalcomprobantes = $this->modelComprobante->getTotalcomprobantes($busqueda);
        $totalPaginas = ceil($totalcomprobantes / $porPagina);
        
        $data = [
            'comprobantes' => $comprobantes,
            'paginaActual' => $pagina,
            'totalPaginas' => $totalPaginas,
            'porPagina' => $porPagina,
            'busqueda' => $busqueda,
            'totalcomprobantes' => $totalcomprobantes
        ];
        require_once __DIR__ . '/../views/comprobantes/index.php';
    }
    public function vista() {
        $id_pedido = $_GET['id'] ?? null;
        $pedido = $this->modelOrden->getOrdenByID($id_pedido);
        $detalles = $this->modelOrden->getOrdenDetalleByID($id_pedido);
        
        require_once __DIR__ . '/../views/comprobantes/view.php';
    }
    public function exportExcel() {
        $comprobantes = $this->model->exportToExcel();
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="comprobantes.xls"');
        header('Cache-Control: max-age=0');
        
        $output = fopen('php://output', 'w');
        
        // Encabezados
        fputcsv($output, array('id_producto', 'codigo', 'producto', 'cod_proveedor'), "\t");
        
        // Datos
        foreach ($comprobantes as $cliente) {
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