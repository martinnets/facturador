<?php include  '../app/Views/layouts/header.php'; ?>
<?php include  '../app/Views/layouts/aside.php'; ?>
       
<div id="main-content" class="flex-1 flex flex-col transition-all duration-300 ease-in-out content-expanded">
<?php include  '../app/Views/layouts/navbar.php'; ?>
<main class="flex-1 p-8 overflow-y-auto">
<div class="grid grid-cols-1 ">

        <!-- Título -->
        <div class="mb-8 animate-fade-in">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard</h1>
            <p class="text-gray-600">Resumen general del sistema</p>
        </div>

        <!-- Tarjetas de estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Clientes -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-200 animate-slide-up">
                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg mb-4 mx-auto">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-1" id="total-clientes">0</h3>
                    <p class="text-gray-600 text-sm">Total Clientes</p>
                </div>
            </div>

            <!-- Total Productos -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-200 animate-slide-up" style="animation-delay: 0.1s">
                <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg mb-4 mx-auto">
                    <i class="fas fa-box text-green-600 text-xl"></i>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-1" id="total-productos">0</h3>
                    <p class="text-gray-600 text-sm">Total Productos</p>
                </div>
            </div>

            <!-- Pedidos Pendientes -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-200 animate-slide-up" style="animation-delay: 0.2s">
                <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-lg mb-4 mx-auto">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-1" id="pedidos-pendientes">0</h3>
                    <p class="text-gray-600 text-sm">Pedidos Pendientes</p>
                </div>
            </div>

            <!-- Ventas Hoy -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-200 animate-slide-up" style="animation-delay: 0.3s">
                <div class="flex items-center justify-center w-12 h-12 bg-cyan-100 rounded-lg mb-4 mx-auto">
                    <i class="fas fa-dollar-sign text-cyan-600 text-xl"></i>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-1" id="ventas-hoy">$0.00</h3>
                    <p class="text-gray-600 text-sm">Ventas Hoy</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1  gap-8 mb-8">
            <!-- Gráfico de Ventas -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-chart-line mr-2 text-blue-600"></i>
                            Ordenes Recientes
                        </h5>
                    </div>
                    <div class="p-6">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Acciones Rápidas -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h5 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-rocket mr-2 text-blue-600"></i>
                    Acciones Rápidas:
                </h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="/orden" class="flex flex-col items-center justify-center p-6 border-2 border-blue-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 text-center group">
                        <i class="fas fa-user-plus text-2xl text-blue-600 mb-3 group-hover:scale-110 transition-transform"></i>
                        <span class="text-blue-700 font-medium">Nuevo Ejecutivo</span>
                    </a>
                    <a href="/facturador/public/orden" class="flex flex-col items-center justify-center p-6 border-2 border-green-200 rounded-lg hover:border-green-400 hover:bg-green-50 transition-all duration-200 text-center group">
                        <i class="fas fa-plus-circle text-2xl text-green-600 mb-3 group-hover:scale-110 transition-transform"></i>
                        <span class="text-green-700 font-medium">Nuevo Producto</span>
                    </a>
                    <a href="/public/orden" class="flex flex-col items-center justify-center p-6 border-2 border-yellow-200 rounded-lg hover:border-yellow-400 hover:bg-yellow-50 transition-all duration-200 text-center group">
                        <i class="fas fa-shopping-cart text-2xl text-yellow-600 mb-3 group-hover:scale-110 transition-transform"></i>
                        <span class="text-yellow-700 font-medium">Nuevo Pedido</span>
                    </a>
                    <a href="/pedidos" class="flex flex-col items-center justify-center p-6 border-2 border-cyan-200 rounded-lg hover:border-cyan-400 hover:bg-cyan-50 transition-all duration-200 text-center group">
                        <i class="fas fa-list text-2xl text-cyan-600 mb-3 group-hover:scale-110 transition-transform"></i>
                        <span class="text-cyan-700 font-medium">Ver Pedidos</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include  '../app/Views/layouts/footer.php'; ?>