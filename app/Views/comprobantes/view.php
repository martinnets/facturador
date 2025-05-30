<?php include  '../app/Views/layouts/header.php'; ?>
<?php include  '../app/Views/layouts/aside.php'; ?>
       
<div id="main-content" class="flex-1 flex flex-col transition-all duration-300 ease-in-out content-expanded">
<?php include  '../app/Views/layouts/navbar.php'; ?>
<main class="flex-1 p-8 overflow-y-auto">
       
<div class="max-w  mx-auto bg-white shadow-lg">
        <!-- Header con Logo y Datos de la Factura -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8 border-b border-gray-200">
            <!-- Logo y Empresa -->
            <div class="flex flex-col">
                <div class="mb-6">
                     
                        <img src="img/giaca.png" alt="Logo" class="h-12"/>
                    
                </div>
                <div class="text-gray-600">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">  </h2>
                    <p class="text-sm">RUC: 20607279790</p>
                    <p class="text-sm">IACA TELECOMUNICACIONES E.I.R.L.</p>
                    <p class="text-sm">AV. MARISCAL CACERES NRO. 820</p>
                </div>
            </div>
             <!-- Datos de la Factura -->
            <div class="lg:text-right">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h1 class="text-3xl font-bold text-blue-800 mb-2 text-center">FACTURA DE VENTA</h1>
                    <div class="text-center text-2xl font-bold text-gray-800 mb-4">
                        <?php echo $pedido['factura']; ?>
                    </div>
                    <?php if ($pedido['id_estado'] === '9'): ?>
                        <div class="bg-red-100 border border-red-300 rounded-lg p-3">
                            <span class="text-red-800 font-bold text-lg">
                                <?php echo $pedido['nombre_estado']; ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Información Principal -->
        <div class="p-8">
            <!-- Detalles de la Nota -->
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-6 mb-8 p-6 bg-gray-50 rounded-lg">
                <div>
                    <span class="text-gray-500 text-sm font-medium">Nota ID</span>
                    <div class="text-lg font-semibold text-gray-800">#<?php echo $pedido['nota']; ?></div>
                </div>
                <div>
                    <span class="text-gray-500 text-sm font-medium">Fecha</span>
                    <div class="text-lg font-semibold text-gray-800"><?php echo date('d/m/Y', strtotime($pedido['fecha'])); ?></div>
                </div>
                <div>
                    <span class="text-gray-500 text-sm font-medium">Referencia</span>
                    <div class="text-lg font-semibold text-gray-800"><?php echo $pedido['tipo_venta']; ?></div>
                </div>
                <div>
                    <span class="text-gray-500 text-sm font-medium">Moneda</span>
                    <div class="text-lg font-semibold text-gray-800">PEN</div>
                </div>
                <div>
                    <span class="text-gray-500 text-sm font-medium">Vendedor</span>
                    <div class="text-lg font-semibold text-gray-800"><?php echo $pedido['nombre_vendedor']; ?></div>
                </div>
            </div>

            <!-- Información de Empresa y Cliente -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Datos de la Empresa -->
                <div class="border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Datos del Proveedor
                    </h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><span class="font-medium">RUC:</span> <?php echo $pedido['ruc']; ?></p>
                        <p><span class="font-medium">Cliente:</span> <?php echo $pedido['nombre_cliente']; ?></p>
                        <p><span class="font-medium">Email:</span> <?php echo $pedido['correo']; ?></p>
                        <p><span class="font-medium">Dirección:</span> <?php echo $pedido['direccion']; ?></p>
                    </div>
                </div>

                <!-- Datos del Cliente -->
                <div class="border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Datos del Cliente
                    </h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><span class="font-medium">RUC:</span> <?php echo $pedido['ruc']; ?></p>
                        <p><span class="font-medium">Cliente:</span> <?php echo $pedido['nombre_cliente']; ?></p>
                        <p><span class="font-medium">Email:</span> <?php echo $pedido['correo']; ?></p>
                        <p><span class="font-medium">Dirección:</span> <?php echo $pedido['direccion']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Tabla de Productos -->
            <div class="border border-gray-200 rounded-lg overflow-hidden mb-8">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-4 px-6 font-semibold text-gray-700">Item</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-700">Producto</th>
                            <th class="text-right py-4 px-6 font-semibold text-gray-700">Cant.</th>
                            <th class="text-right py-4 px-6 font-semibold text-gray-700">P. Unit.</th>
                            <th class="text-right py-4 px-6 font-semibold text-gray-700">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($detalles as $index => $item): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 text-gray-800"><?php echo $index + 1; ?></td>
                            <td class="py-4 px-6 text-gray-800"><?php echo $item['producto']; ?></td>
                            <td class="py-4 px-6 text-right text-gray-800 text-end"><?php echo $item['cantidad']; ?></td>
                            <td class="py-4 px-6 text-right text-gray-800 text-end">S/ <?php echo $item['precio']; ?></td>
                            <td class="py-4 px-6 text-right text-gray-800 font-semibold text-end">
                                S/ <?php echo $item['cantidad'] * $item['precio']; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr class="border-t-2 border-gray-300">
                            <td colspan="4" class="py-6 px-6 text-right text-xl font-bold text-gray-800">
                                TOTAL GENERAL:
                            </td>
                            <td class="py-6 px-6 text-right text-2xl font-bold text-blue-600">
                                S/ <?php echo $pedido['total']; ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Términos y Condiciones -->
            <div class="border-t border-gray-200 pt-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-sm text-gray-600">
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">Términos y Condiciones:</h4>
                        <ul class="space-y-1">
                            <li>• El pago debe realizarse dentro de los 30 días</li>
                            <li>• Los productos entregados están sujetos a garantía</li>
                            <li>• Esta nota de venta es válida por 7 días</li>
                        </ul>
                    </div>
                    <div class="lg:text-right">
                        <h4 class="font-semibold text-gray-800 mb-2">Información Adicional:</h4>
                        <p>Gracias por su preferencia</p>
                        <p class="mt-2 text-xs text-gray-500">
                            Documento generado el <?php echo date('d/m/Y H:i:s'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="no-print bg-gray-50 p-6 border-t border-gray-200 flex justify-center space-x-4">
            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                🖨️ Imprimir
            </button>
            <button onclick="downloadPDF()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                📄 Descargar PDF
            </button>
            <button onclick="sendEmail()" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                📧 Enviar por Email
            </button>
        </div>
    </div>

    <script>
        function downloadPDF() {
            alert('Función de descarga PDF - Implementar según necesidades');
        }

        function sendEmail() {
            alert('Función de envío de email - Implementar según necesidades');
        }

        // Configuración adicional de Tailwind para impresión
        tailwind.config = {
            theme: {
                extend: {
                    screens: {
                        'print': {'raw': 'print'},
                    }
                }
            }
        }
    </script>

</main>
 
<?php include  '../app/Views/layouts/footer.php'; ?>