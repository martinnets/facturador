<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/debug.log');
// Asegurar que la carpeta de salida existe
$outputDir = __DIR__ . '/cpe/';
error_log("Directorio de salida");
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0777, true); // crea la carpeta si no existe
}
// Recibir el JSON desde el fetch
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['seleccionados']) || !is_array($data['seleccionados'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Datos inválidos']);
    exit;
}

$seleccionados = $data['seleccionados'];
$facturasGeneradas = [];

// Verificar si hay pedidos seleccionados
var_dump($seleccionados);
// Simular creación de JSON de facturas electrónicas y PDFs
foreach ($seleccionados as $id) {
    // Aquí iría tu lógica real: buscar datos, crear factura JSON, enviar a API, guardar PDF...
    file_put_contents("facturas/factura_$id.json", json_encode([
        'pedido_id' => $id,
        'fecha' => date('Y-m-d'),
        'monto_total' => rand(100, 1000),
        'estado' => 'procesado'
    ], JSON_PRETTY_PRINT));
    $filePath = $outputDir . "factura_$id.json";

    // Guardar el archivo JSON
    file_put_contents($filePath, json_encode($factura, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    $facturasGeneradas[] = "factura_$id.json";
}

//echo json_encode(['status' => 'ok']);
// Respuesta para confirmar éxito
echo json_encode([
    'status' => 'ok',
    'mensaje' => 'Facturas generadas',
    'archivos' => $facturasGeneradas
]);
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['seleccionados'])) {
//     $seleccionados = $_POST['seleccionados'];
//     $facturas = [];
//     error_log("Pedidos seleccionados: " . $seleccionados);
//     foreach ($seleccionados as $id) {
//         $facturas[] = [
//             'pedido_id' => $id,
//             'fecha_emision' => date('Y-m-d'),
//             'cliente' => 'Consumidor Final',
//             'items' => [], // Aquí agregarías productos
//         ];
//     }

//     $json = json_encode($facturas, JSON_PRETTY_PRINT);
//     error_log("Facturas generadas: " . $json);
//     // Simulación de llamada a API para generar PDF
//     file_put_contents("output_facturas.json", $json);
    
//     echo "<h2 class='text-xl'>Facturas generadas:</h2><pre>$json</pre>";
// } else {
//     echo "No se recibieron pedidos seleccionados.";
// }
