<?php
require_once 'Database.php';
class Producto {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM productos ORDER BY producto");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($producto, $precio = 0) {
        $stmt = $this->db->prepare("INSERT INTO productos (producto, precio) VALUES (?, ?)");
        return $stmt->execute([$producto, $precio]);
    }
    
    public function update($id, $producto, $precio) {
        $stmt = $this->db->prepare("UPDATE productos SET producto = ?, precio = ? WHERE id = ?");
        return $stmt->execute([$producto, $precio, $id]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>