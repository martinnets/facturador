// ==================== controllers/ProductoController.php ====================
<?php
class ProductoController {
    private $model;
    
    public function __construct() {
        $this->model = new Producto();
    }
    
    public function index() {
        $productos = $this->model->getAll();
        include 'views/productos/index.php';
    }
    
    public function create() {
        if ($_POST) {
            if ($this->model->create($_POST['producto'], $_POST['precio'])) {
                header('Location: ?controller=producto');
                exit;
            }
        }
        include 'views/productos/create.php';
    }
    
    public function edit() {
        $id = $_GET['id'];
        $producto = $this->model->getById($id);
        
        if ($_POST) {
            if ($this->model->update($id, $_POST['producto'], $_POST['precio'])) {
                header('Location: ?controller=producto');
                exit;
            }
        }
        include 'views/productos/edit.php';
    }
    
    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: ?controller=producto');
        exit;
    }
}
?>