<?php

namespace Models;
use Core\Database;

class Cliente {
    private $conn;
    private $table_name = "clientes";

    public $id;
    public $cliente;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function readAll() {
        $query = "SELECT id_cliente, codigo,nombre_cliente,nombre_comercial,telefono,correo
        FROM " . $this->table_name . " ORDER BY id_cliente ASC LIMIT 10";
         
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        //$clientes = $stmt->fetchAll();
        $clientes= $stmt->fetchAll();

        return $clientes;
        // return json_encode([
        //     'success' => !empty($clientes),
        //     'data' => $clientes,
        //     'total' => count($clientes),
        //     'message' => empty($clientes) ? 'No se encontraron clientes' : 'Clientes obtenidos correctamente'
        // ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        // //return $stmt->fetchAll();

       // return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET cliente=:cliente";
        $stmt = $this->conn->prepare($query);

        $this->cliente = htmlspecialchars(strip_tags($this->cliente));

        $stmt->bindParam(":cliente", $this->cliente);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne() {
        $query = "SELECT id_cliente, nombre_cliente FROM " . $this->table_name . " WHERE id_cliente = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            $this->cliente = $row['cliente'];
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre_cliente=:cliente WHERE id_cliente=:id";
        $stmt = $this->conn->prepare($query);

        $this->cliente = htmlspecialchars(strip_tags($this->cliente));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":cliente", $this->cliente);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_cliente = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function getClientes($pagina = 1, $porPagina = 10, $busqueda = '') {
        $offset = ($pagina - 1) * $porPagina;
        
        $query = "SELECT * FROM clientes";
        $params = [];
        
        if (!empty($busqueda)) {
            $query .= " WHERE nombre_cliente LIKE :busqueda OR codigo LIKE :busqueda";
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

    public function getTotalClientes($busqueda = '') {
        $query = "SELECT COUNT(*) as total FROM clientes";
        
        if (!empty($busqueda)) {
            $query .= " WHERE nombre_cliente LIKE :busqueda OR codigo LIKE :busqueda";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':busqueda', "%$busqueda%");
        } else {
            $stmt = $this->conn->prepare($query);
        }
        
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function exportarExcel() {
        $stmt = $this->conn->query("SELECT * FROM clientes");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}