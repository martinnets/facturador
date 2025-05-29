<?php
require_once 'Database.php';

class DetallePedido {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getByPedidoId($pedido_id) {
        $stmt = $this->db->prepare("
            SELECT dp.*, pr.producto 
            FROM detalle_pedidos dp 
            JOIN productos pr ON dp.producto_id = pr.id 
            WHERE dp.pedido_id = ?
        ");
        $stmt->execute([$pedido_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($pedido_id, $producto_id, $cantidad, $precio) {
        $subtotal = $cantidad * $precio;
        $stmt = $this->db->prepare("
            INSERT INTO detalle_pedidos (pedido_id, producto_id, cantidad, precio, subtotal) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$pedido_id, $producto_id, $cantidad, $precio, $subtotal]);
    }
    
    public function deleteByPedidoId($pedido_id) {
        $stmt = $this->db->prepare("DELETE FROM detalle_pedidos WHERE pedido_id = ?");
        return $stmt->execute([$pedido_id]);
    }
}
?>