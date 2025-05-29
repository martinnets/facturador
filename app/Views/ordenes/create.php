<?php include  '../app/Views/layouts/header.php'; ?>
<?php include  '../app/Views/layouts/aside.php'; ?>
       
        <div id="main-content" class="flex-1 flex flex-col transition-all duration-300 ease-in-out content-expanded">
        <?php include  '../app/Views/layouts/navbar.php'; ?>
        <main class="flex-1 p-8 overflow-y-auto">
        <div class="container mx-auto px-4 py-8">
        <!-- Encabezado -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-file-invoice mr-2"></i>
                Pedido #<?= htmlspecialchars($id_pedido) ?>
            </h1>
           
            <div class="mt-6 flex justify-end space-x-3">
            <a href="pedidos.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Pedidos
            </a>
            
            <button class="bg-red-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                <i class="fas fa-file-pdf mr-2"></i> Generar CPE
            </button>
        </div>
        </div>

        <!-- Sección Maestro (Datos del Pedido) -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">Información del Pedido</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Número de Pedido</label>
                    <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($pedido['id']) ?></p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-500">Fecha</label>
                    <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($pedido['fecha']) ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Fecha Entrega</label>
                    <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($pedido['fecha_entrega']) ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Estado</label>
                    <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        <?= $pedido['nombre_estado'] == 'Pendiente' ? 'bg-yellow-100 text-yellow-800' : 
                           ($pedido['nombre_estado'] == 'Completado' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') ?>">
                        <?= htmlspecialchars($pedido['nombre_estado']) ?>
                    </span>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500">Cliente</label>
                    <p class="mt-1 text-sm text-gray-900">
                        <?= htmlspecialchars($pedido['nombre_cliente']) ?> (ID: <?= htmlspecialchars($pedido['id_cliente']) ?>)
                    </p>
                </div>
                 
            </div>
        </div>

        <!-- Sección Detalle (Productos del Pedido) -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Detalle del Pedido</h2>
               
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($detalles as $detalle): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($detalle['producto']) ?></div>
                                <div class="text-sm text-gray-500">COD: <?= htmlspecialchars($detalle['codigo']) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= number_format($detalle['precio'], 2) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="number" min="1" value="<?= htmlspecialchars($detalle['cantidad']) ?>" 
                                    class="w-20 border rounded-md px-2 py-1 text-sm">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <?= number_format($detalle['subtotal'], 2) ?>
                            </td>
                           
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-500 uppercase">Total</td>
                            <td class="px-6 py-3 text-sm font-bold text-gray-900">$<?= number_format($pedido['total'], 2) ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="mt-6 flex justify-end space-x-3">
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                <i class="fas fa-print mr-2"></i> Imprimir
            </button>
            
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                <i class="fas fa-check mr-2"></i> Completar Pedido
            </button>
        </div>
    </div>

    <!-- Modal para agregar producto (simulado) -->
    <script>
        function agregarProducto() {
            alert('Funcionalidad para agregar producto se implementaría aquí');
            // En una aplicación real, esto abriría un modal o una nueva vista
            // para seleccionar productos y agregarlos al pedido
        }
    </script>
</main>
<?php include  '../app/Views/layouts/footer.php'; ?>