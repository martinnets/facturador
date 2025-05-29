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
            
            <form id="filtrosForm" method="get" class="grid grid-cols-5  ">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buscar Orden</label>
                    <input type="hidden" name="pagina" value="1">
                    <input type="text" name="id"  value="<?= htmlspecialchars($data['id']) ?>"  
                           placeholder="Buscar Ordenes..." class="flex-grow px-4 py-2 border rounded-l-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo Pago</label>
                     <select name="estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tipo Pago</option>
                        <option value="Contado" <?= (($_GET['pago'] ?? '') === 'Contado') ? 'selected' : '' ?>>Contado</option>
                        <option value="Credito" <?= (($_GET['pago'] ?? '') === 'Credito') ? 'selected' : '' ?>>Credito</option>                                                
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                     <select name="estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tipo Pago</option>
                        <option value="Pendiente" <?= (($_GET['estado'] ?? '') === 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                        <option value="Facturado" <?= (($_GET['estado'] ?? '') === 'Facturado') ? 'selected' : '' ?>>Facturado</option>
                        <option value="Despachado" <?= (($_GET['estado'] ?? '') === 'Despachado') ? 'selected' : '' ?>>Despachado</option>
                        
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cliente:</label>
                     <input type="text" name="cliente"  
                           placeholder="Buscar Cliente..." class="flex-grow px-4 py-2 border rounded-l-md">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-search mr-2"></i>Filtrar
                    </button>
                    
                    <button type="button" onclick="limpiarFiltros()" class="px-3 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Formulario de búsqueda -->
            
            
            <!-- Tabla de Ordenes -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border">Acción</th>
                            <th class="py-2 px-4 border">CPE</th>
                            <th class="py-2 px-4 border">Nro Pedido</th>
                            <th class="py-2 px-4 border">Nro Marketch</th>
                            <th class="py-2 px-4 border">Tipo Pago</th>
                            <th class="py-2 px-4 border">Cliente</th>
                            <th class="py-2 px-4 border">Estado</th>
                            <th class="py-2 px-4 border">Vendedor</th>
                            <th class="py-2 px-4 border">F.Pedido</th>
                            <th class="py-2 px-4 border">F.Entrega</th>
                            <th class="py-2 px-4 border">Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['ordenes'] as $orden): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($orden['factura'] == ''): ?>
                                      
                                <a href="<?php echo '/facturador/public/orden/create?id='.$orden['id']?>" class="bg-red-400 hover:bg-red-500 font-bold py-1 px-2 
                                                rounded"><i class="fas fa-file-pdf text-white"></i></a>
                            <?php endif; ?>    
                                                                                        
                                            </td> 
                            <td class="py-2 px-4 border"><?= htmlspecialchars($orden['factura']) ?></td>

                            <td class="py-2 px-4 border"><?= htmlspecialchars($orden['id']) ?></td>
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
                                    <?= htmlspecialchars($orden['nombre_estado']) ?></span>
                            <?php elseif($orden['id_estado'] == '5'): ?>
                                    <span class='bg-green-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['nombre_estado']) ?></span>
                            <?php elseif($orden['id_estado'] == '6'): ?>
                                    <span class='bg-yellow-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['nombre_estado']) ?></span>  
                            <?php elseif($orden['id_estado'] == '7'): ?>
                                    <span class='bg-blue-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['nombre_estado']) ?></span>     
                            <?php elseif($orden['id_estado'] == '8'): ?>
                                    <span class='bg-Purple-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['nombre_estado']) ?></span>
                            <?php elseif($orden['id_estado'] == '9'): ?>
                                    <span class='bg-Pink-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'>
                                    <?= htmlspecialchars($orden['nombre_estado']) ?></span>                                                                                                                                         
                            <?php endif; ?>       
                            </td>
                             
                            <td class="py-2 px-4 border"><?= htmlspecialchars($orden['nombre_vendedor']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($orden['fecha']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($orden['fecha_entrega']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($orden['nota']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
      
<?php include  '../app/Views/layouts/footer.php'; ?>