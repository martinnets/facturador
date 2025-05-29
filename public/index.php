<?php
// Agregar al inicio del archivo
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/debug.log');
// Cargar el autoloader de Composer si lo usas, o un autoloader simple.
// require_once '../vendor/autoload.php'; // Si usas Composer

// Autoloader simple (si no usas Composer)
spl_autoload_register(function ($className) {
    // Reemplaza las barras invertidas del namespace con barras normales del directorio
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $file = __DIR__ . '/../app/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Iniciar la aplicación
$app = new Core\App();
?>