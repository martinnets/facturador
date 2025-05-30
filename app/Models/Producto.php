<?php

namespace Models;
use Core\Database;

class Producto {
    private $conn;
    private $table_name = "productos";

    public $id;
    public $cliente;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    
    public function getproductos($pagina = 1, $porPagina = 10, $busqueda = '') {
        $offset = ($pagina - 1) * $porPagina;
        
        $query = "SELECT * FROM productos";
        $params = [];
        
        if (!empty($busqueda)) {
            $query .= " WHERE codigo LIKE :busqueda OR producto LIKE :busqueda";
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

    public function getTotalproductos($busqueda = '') {
        $query = "SELECT COUNT(*) as total FROM productos";
        
        if (!empty($busqueda)) {
            $query .= " WHERE codigo LIKE :busqueda OR producto LIKE :busqueda";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':busqueda', "%$busqueda%");
        } else {
            $stmt = $this->conn->prepare($query);
        }
        
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function exportarExcel() {
        $stmt = $this->conn->query("SELECT * FROM productos");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}