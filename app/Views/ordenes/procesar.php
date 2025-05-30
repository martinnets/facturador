<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['seleccionados'])) {
    $seleccionados = $_POST['seleccionados'];
    $facturas = [];

    foreach ($seleccionados as $id) {
        $facturas[] = [
            'pedido_id' => $id,
            'fecha_emision' => date('Y-m-d'),
            'cliente' => 'Consumidor Final',
            'items' => [], // Aquí agregarías productos
        ];
    }

    $json = json_encode($facturas, JSON_PRETTY_PRINT);

    // Simulación de llamada a API para generar PDF
    file_put_contents("output_facturas.json", $json);
    
    echo "<h2 class='text-xl'>Facturas generadas:</h2><pre>$json</pre>";
} else {
    echo "No se recibieron pedidos seleccionados.";
}
