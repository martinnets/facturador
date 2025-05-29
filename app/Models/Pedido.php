<?php
require_once 'Database.php';
class Pedido {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getAll() {
        $stmt = $this->db->query("
            SELECT p.*, c.cliente 
            FROM pedidos p 
            JOIN clientes c ON p.cliente_id = c.id 
            ORDER BY p.fecha DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT p.*, c.cliente 
            FROM pedidos p 
            JOIN clientes c ON p.cliente_id = c.id 
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($cliente_id, $fecha) {
        $stmt = $this->db->prepare("INSERT INTO pedidos (cliente_id, fecha) VALUES (?, ?)");
        $stmt->execute([$cliente_id, $fecha]);
        return $this->db->lastInsertId();
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM pedidos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>