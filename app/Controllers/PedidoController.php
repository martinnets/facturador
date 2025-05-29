<?php
namespace Controllers;

use Core\Controller;
use Models\Pedido;
use Models\Cliente;
use Models\Producto;
use Models\DetallePedido;
class PedidoController extends Controller  {

    private $pedidoModel;
    private $clienteModel;
    private $productoModel; 
    private $detalleModel;
    
    public function __construct() {
        $this->pedidoModel = new Pedido();
        $this->clienteModel = new Cliente();
        $this->productoModel = new Producto();
        $this->detalleModel = new DetallePedido();
    }
    
    public function index() {
        $pedidos = $this->pedidoModel->getAll();
        require_once __DIR__ . '/../views/pedidos/index.php';
        //include 'views/pedidos/index.php';
    }
    
    public function create() {
        $clientes = $this->clienteModel->getAll();
        $productos = $this->productoModel->getAll();
        
        if ($_POST) {
            $pedido_id = $this->pedidoModel->create($_POST['cliente_id'], $_POST['fecha']);
            
            if (isset($_POST['productos']) && is_array($_POST['productos'])) {
                foreach ($_POST['productos'] as $item) {
                    if ($item['producto_id'] && $item['cantidad']) {
                        $producto = $this->productoModel->getById($item['producto_id']);
                        $precio = $item['precio'] ?: $producto['precio'];
                        $this->detalleModel->create($pedido_id, $item['producto_id'], $item['cantidad'], $precio);
                    }
                }
            }
            
            header('Location: ?controller=pedido');
            exit;
        }
        include 'views/pedidos/create.php';
    }
    
    // public function view() {
    //     $id = $_GET['id'];
    //     $pedido = $this->pedidoModel->getById($id);
    //     $detalles = $this->detalleModel->getByPedidoId($id);
    //     include 'views/pedidos/view.php';
    // }
    
    public function delete() {
        $id = $_GET['id'];
        $this->detalleModel->deleteByPedidoId($id);
        $this->pedidoModel->delete($id);
        header('Location: ?controller=pedido');
        exit;
    }
}
?>