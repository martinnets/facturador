<?php
namespace Models;
use Core\Database;
class Pedido {
    private $conn;
    private $table_name = "pedidos";

    public $id;
    public $pedidos;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    public function getPedidos($pagina = 1, $porPagina = 10, $busqueda = '') {
        $offset = ($pagina - 1) * $porPagina;
        
        $query = "SELECT * FROM pedidos";
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
}
?>