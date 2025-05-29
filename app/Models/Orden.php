<?php

namespace Models;
use Core\Database;

class Orden {
    private $conn;
    private $table_name = "orden";

    public $id;
    public $cliente;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
 
    public function getOrdenes($pagina = 1, $porPagina = 10, $busqueda = '') {
        $offset = ($pagina - 1) * $porPagina;
        
        $query = "SELECT * FROM orden";
        $query = "SELECT
                MAX(os.id) AS id,
                CONCAT(comp.serie,'-',comp.numero) AS factura,
                pe.id_pedido_ejecutivo,
                CONCAT(c.nombre_cliente,' - Entrega: ',pe.direccion_entrega) AS nombre_cliente,
                c.encargado,
                e.id_ejecutivo,
                e.nombre_vendedor,
                pe.id_proforma,
                pe.tipo_venta,
                pe.fecha,
                est.nombre_estado,
                pe.fecha_entrega,
                pe.id_repartidor,
                IFNULL(pe.nombre_cliente,'--') AS nota,
                pe.id_estado ,
                os.comentario,
                pe.comentarios AS comentario_vendedor,
                os.fecha AS fecha_seguimiento,
                c.id_cliente,
                tp.nombre_tipo_pago
                FROM orden pe
                INNER JOIN clientes c ON pe.id_cliente = c.id_cliente
                INNER JOIN ejecutivos e ON pe.id_ejecutivo = e.id_ejecutivo
                INNER JOIN tipo_pago tp ON pe.id_tipo_pago = tp.id_tipo_pago
                INNER JOIN orden_seguimiento os ON os.id_pedido = pe.id_pedido_ejecutivo
                INNER JOIN estados est ON pe.id_estado = est.id_estado
                LEFT JOIN documentos_salida ds ON ds.id_pedido = pe.id_pedido_ejecutivo AND ds.estado = 1
                LEFT JOIN comprobantes  comp ON ds.id_comprobante = comp.id_comprobante";
        $params = [];
        
        if (!empty($busqueda)) {
            $query .= " WHERE tipo_venta LIKE :busqueda OR id_estado LIKE :busqueda";
            $params[':busqueda'] = "%$busqueda%";
        }
        
        $query .= " GROUP BY pe.id_pedido_ejecutivo 
                    ORDER BY pe.fecha DESC LIMIT :offset, :porPagina";
        
        $stmt = $this->conn->prepare($query);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->bindValue(':porPagina', $porPagina, \PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTotalOrdenes($busqueda = '') {
        $query = "SELECT COUNT(*) as total FROM orden";
        
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
        $stmt = $this->conn->query("SELECT * FROM orden");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}