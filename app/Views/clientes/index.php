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
                Filtros de Búsqueda - Clientes
            </h2>
            
            <form id="filtrosForm" method="get" class="grid grid-cols-2  ">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buscar Clientes</label>
                    <input type="hidden" name="pagina" value="1">
                    <input type="text" name="busqueda" value="<?= htmlspecialchars($data['busqueda']) ?>" 
                           placeholder="Buscar clientes..." class="flex-grow px-4 py-2 border rounded-l-md">
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
            
            
            <!-- Tabla de clientes -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border">ID</th>
                            <th class="py-2 px-4 border">Código</th>
                            <th class="py-2 px-4 border">Nombre</th>
                            <th class="py-2 px-4 border">Teléfono</th>
                            <th class="py-2 px-4 border">Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['clientes'] as $cliente): ?>
                        <tr>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($cliente['id_cliente']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($cliente['codigo']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($cliente['nombre_cliente']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($cliente['telefono']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($cliente['correo']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación -->
            <div class="flex justify-between items-center mt-4">
                <div>
                    <span class="text-gray-700">
                        Mostrando <?= count($data['clientes']) ?> de <?= $data['totalClientes'] ?> clientes
                    </span>
                </div>
                <div class="flex space-x-2">
                    <?php if ($data['paginaActual'] > 1): ?>
                        <a href="?pagina=<?= $data['paginaActual'] - 1 ?>&por_pagina=<?= $data['porPagina'] ?>&busqueda=<?= urlencode($data['busqueda']) ?>" 
                           class="px-4 py-2 border rounded-md hover:bg-gray-100">
                            Anterior
                        </a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $data['totalPaginas']; $i++): ?>
                        <a href="?pagina=<?= $i ?>&por_pagina=<?= $data['porPagina'] ?>&busqueda=<?= urlencode($data['busqueda']) ?>" 
                           class="px-4 py-2 border rounded-md <?= $i == $data['paginaActual'] ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php if ($data['paginaActual'] < $data['totalPaginas']): ?>
                        <a href="?pagina=<?= $data['paginaActual'] + 1 ?>&por_pagina=<?= $data['porPagina'] ?>&busqueda=<?= urlencode($data['busqueda']) ?>" 
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