<?php

namespace Models;
use Core\Database;

class Comprobante {
    private $conn;
    private $table_name = "comprobantes";

    public $id;
    public $cliente;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    
    public function getcomprobantes($pagina = 1, $porPagina = 10, $busqueda = '') {
        $offset = ($pagina - 1) * $porPagina;
        
        $query = "SELECT * FROM comprobantes";
        $params = [];
        
        if (!empty($busqueda)) {
            $query .= " WHERE serie LIKE :busqueda OR numero LIKE :busqueda";
            $params[':busqueda'] = "%$busqueda%";
        }
        
        $query .= " LIMIT :offset, :porPagina";
        
        $stmt = $this->conn->prepare($query);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->bindValue(':porPagina', $porPagina, \PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTotalcomprobantes($busqueda = '') {
        $query = "SELECT COUNT(*) as total FROM comprobantes";
        
        if (!empty($busqueda)) {
            $query .= " WHERE serie LIKE :busqueda OR numero LIKE :busqueda";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':busqueda', "%$busqueda%");
        } else {
            $stmt = $this->conn->prepare($query);
        }
        
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function exportarExcel() {
        $stmt = $this->conn->query("SELECT * FROM comprobantes");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}