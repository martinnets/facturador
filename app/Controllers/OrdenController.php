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
        $id = $_GET['id'] ?? '';
        $pago = $_GET['pago'] ?? '';
        $estado = $_GET['estado'] ?? '';
        $cliente = $_GET['cliente'] ?? '';

        $ordenes = $this->model->getOrdenes($pagina, $porPagina, $id,$pago,$estado,$cliente);
        $totalordenes = $this->model->getTotalOrdenes($id,$pago,$estado,$cliente);
        $totalPaginas = ceil($totalordenes / $porPagina);
        
        $data = [
            'ordenes' => $ordenes,
            'paginaActual' => $pagina,
            'totalPaginas' => $totalPaginas,
            'porPagina' => $porPagina,
            'id' => $id,
            'pago' => $pago,
            'estado' => $estado,
            'cliente' => $cliente ,
            'totalordenes' => $totalordenes
        ];
        require_once __DIR__ . '/../views/ordenes/index.php';
    }
    public function create() {
        $id_pedido = $_GET['id'] ?? null;
        $pedido = $this->model->getOrdenByID($id_pedido);
        $detalles = $this->model->getOrdenDetalleByID($id_pedido);

        require_once __DIR__ . '/../views/ordenes/create.php';
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