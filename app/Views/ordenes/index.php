<?php include  '../app/Views/layouts/header.php'; ?>
<?php include  '../app/Views/layouts/aside.php'; ?>
       
        <div id="main-content" class="flex-1 flex flex-col transition-all duration-300 ease-in-out content-expanded">
        <?php include  '../app/Views/layouts/navbar.php'; ?>
 <main class="flex-1 p-8 overflow-y-auto">
    <div class="grid grid-cols-1 ">
          <!-- Filtros -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-filter mr-2 text-gray-600"></i>
                Filtros de Búsqueda - Ordenes
            </h2>
            <form method="GET" class="mb-4 flex gap-2">
                <input type="text" name="id" placeholder="Filtrar por ID" class="border p-2 rounded">
                <input type="text" name="estado" placeholder="Filtrar por Estado" class="border p-2 rounded">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                <i class="fas fa-search mr-2"></i>Filtrar</button>
            </form>
             
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Formulario de búsqueda -->
            
            
            <!-- Tabla de Ordenes -->
            <div class="overflow-x-auto">
            <!-- <form method="POST" action="/facturador/public/orden/procesar.php"> -->
            <form id="facturaForm" method="post" action="javascript:void(0);" >
                <div class="text-end">
                    
                <button  id="btnGenerar" type="submit" class="mt-4 bg-red-600 text-white px-4 py-2 rounded">
                <i class="fas fa-file-pdf mr-2"></i>Generar Facturas</button>
                </div>
               
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr class="bg-gray-100">
                        <th class="py-2 px-4 w-12">
                        <input type="checkbox" id="selectAll" onclick="toggleAll(this)" 
                        class="form-checkbox h-5 w-5 text-blue-600">
                                </th>       
                                              
                            <th class="py-2 px-4 border">Id</th>
                            <th class="py-2 px-4 border">Tipo Pago</th>
                            <th class="py-2 px-4 border">Cliente</th>
                            <th class="py-2 px-4 border">Estado</th>
                            <th class="py-2 px-4 border">Vendedor</th>
                            <th class="py-2 px-4 border">F.Pedido</th>
                            <th class="py-2 px-4 border">F.Entrega</th>
                            <th class="py-2 px-4 border">Total</th>
                            <th class="py-2 px-4 border">Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['ordenes'] as $orden): ?>
                        <tr>
                           
                        <td class="text-center"><input class="form-checkbox h-5 w-5 text-blue-600" 
                        type="checkbox" 
                        name="seleccionados[]" 
                        value="<?= $orden['id_pedido_ejecutivo'] ?>"></td>


                            <td class="py-2 px-4 border">
                            <a href="<?php echo '/facturador/public/orden/create?id='.$orden['id_pedido_ejecutivo']?>"
                             class="bg-blue-400 hover:bg-blue-100 font-bold py-1 px-2 
                            rounded"> 
                            <?= htmlspecialchars($orden['id_pedido_ejecutivo']) ?></a></td>
                            <td class="py-2 px-4 border">
                            <?php if ($orden['nombre_tipo_pago'] == 'Contado'): ?>
                                    <span class='bg-blue-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full  '>
                                    Contado</span>
                            <?php else: ?>
                                    <span class='bg-red-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    Crédito</span>
                            <?php endif; ?>    
                            
                            </td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($orden['nombre_cliente']) ?></td>

                            <td class="py-2 px-4 border">
                            <?php if ($orden['id_estado'] == '3'): ?>
                                    <span class='bg-red-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full  '>
                                    Pendiente</span>
                            <?php elseif($orden['id_estado'] == '4'): ?>
                                    <span class='bg-red-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['id_estado']) ?></span>
                            <?php elseif($orden['id_estado'] == '5'): ?>
                                    <span class='bg-green-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['id_estado']) ?></span>
                            <?php elseif($orden['id_estado'] == '6'): ?>
                                    <span class='bg-yellow-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['id_estado']) ?></span>  
                            <?php elseif($orden['id_estado'] == '7'): ?>
                                    <span class='bg-blue-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['id_estado']) ?></span>     
                            <?php elseif($orden['id_estado'] == '8'): ?>
                                    <span class='bg-Purple-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['id_estado']) ?></span>
                            <?php elseif($orden['id_estado'] == '9'): ?>
                                    <span class='bg-Pink-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['id_estado']) ?></span>                                                                                                                                         
                            <?php endif; ?>       
                            </td>
                             
                            <td class="py-2 px-4 border"><?= htmlspecialchars($orden['nombre_vendedor']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($orden['fecha']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($orden['fecha_entrega']) ?></td>
                            <td class="py-2 px-4 border text-end"><?= htmlspecialchars($orden['total']) ?></td>
                            <td class="py-2 px-4 border text-end"><?= htmlspecialchars($orden['tipo_precio']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </form>
            <!-- Popup de carga -->
<div id="popupLoading" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center">
    <svg class="animate-spin h-8 w-8 text-green-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
    </svg>
    <p class="text-gray-700 text-sm font-medium">Procesando facturas electrónicas...</p>
  </div>
</div>
            </div>
            
            <!-- Paginación -->
            <div class="flex justify-between items-center mt-4">
                <div>
                    <span class="text-gray-700">
                        Mostrando <?= count($data['ordenes']) ?> de <?= $data['totalordenes'] ?> Ordenes
                    </span>
                </div>
                <div class="flex space-x-2">
                    <?php if ($data['paginaActual'] > 1): ?>
                        <a href="?pagina=<?= $data['paginaActual'] - 1 ?>&por_pagina=<?= $data['porPagina'] ?>&id=<?= urlencode($data['id']) ?>" 
                           class="px-4 py-2 border rounded-md hover:bg-gray-100">
                            Anterior
                        </a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $data['totalPaginas']; $i++): ?>
                        <a href="?pagina=<?= $i ?>&por_pagina=<?= $data['porPagina'] ?>&id=<?= urlencode($data['id']) ?>" 
                           class="px-4 py-2 border rounded-md <?= $i == $data['paginaActual'] ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php if ($data['paginaActual'] < $data['totalPaginas']): ?>
                        <a href="?pagina=<?= $data['paginaActual'] + 1 ?>&por_pagina=<?= $data['porPagina'] ?>&id=<?= urlencode($data['id']) ?>" 
                           class="px-4 py-2 border rounded-md hover:bg-gray-100">
                            Siguiente
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Exportar a Excel -->
            <div class="mt-6">
                <a href="?action=export" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md inline-block">
                    Exportar a Excel
                </a>
            </div>
        </div>
   
    </div>
       

</main>
               
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    function toggleAll(source) {
      checkboxes = document.querySelectorAll('input[name="seleccionados[]"]');
      for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
      }
    }
    
    document.getElementById('facturaForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const popup = document.getElementById('popupLoading');
        const seleccionados = [...form.querySelectorAll('input[name="seleccionados[]"]:checked')].map(i => i.value);
        if (seleccionados.length === 0) {
            alert("Selecciona al menos un pedido.");
            return;
        }
        console.log("Pedidos seleccionados:", seleccionados);
        // Mostrar popup de carga
        popup.classList.remove('hidden');
        try {
            // const response = await fetch('/facturador/public/orden/procesar.php', {
            // method: 'POST',
            // body: new URLSearchParams({ 'seleccionados[]': seleccionados })
            // });

            // await response.text();

            // // Redirigir al terminar
            // setTimeout(() => {
            // window.location.href = '/facturador/public/comprobante/index.php';
            // }, 1000);
            console.log(JSON.stringify({ seleccionados }))
            const response = await fetch('/facturador/public/orden/procesar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ seleccionados })
                });

                await response.text();

                setTimeout(() => {
                window.location.href = '/facturador/public/comprobante/index.php';
                }, 1000);
        } catch (error) {
            alert("Ocurrió un error al procesar los pedidos.");
            console.error(error);
            popup.classList.add('hidden');
        }
        });
</script>

<script>
    // Seleccionar/deseleccionar todos los checkboxes
    document.getElementById('selectAll').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.pedido-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
    });

    // Validar que se haya seleccionado al menos un pedido
    function validarSeleccion() {
        const checkboxes = document.querySelectorAll('.pedido-checkbox:checked');
        if (checkboxes.length === 0) {
            alert('Por favor seleccione al menos un pedido');
            return false;
        }
        return true;
    }
</script>
<?php include  '../app/Views/layouts/footer.php'; ?>