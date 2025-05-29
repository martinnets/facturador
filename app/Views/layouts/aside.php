<aside id="sidebar" class="bg-gray-800 text-white p-4 space-y-6 shadow-xl fixed top-0 left-0 h-full z-20 transition-all duration-300 ease-in-out sidebar-expanded">
            <div class="text-center mb-8 py-2">
                <a href="/facturador/public/" class="text-2xl font-semibold hover:text-gray-300 flex items-center justify-center">
                     <img class="dark:hidden h-50" src="img/giaca.png" alt="Logo" />
                </a>
            </div>
            <nav class="bg-gray-800 text-white rounded-lg p-2 space-y-2">
                <a href="/facturador/public/"
                 class="nav-link flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-home w-6 mr-3"></i> <span class="sidebar-text">Inicio</span>
                </a>
                <a href="/facturador/public/pedido" class="nav-link flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-users w-6 mr-3"></i> <span class="sidebar-text">Pedidos</span>
                </a>
                <a href="/facturador/public/cliente" class="nav-link flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-users w-6 mr-3"></i> <span class="sidebar-text">Clientes</span>
                </a>
                <a href="/facturador/public/producto" class="nav-link flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-box-open w-6 mr-3"></i> <span class="sidebar-text">Productos</span>
                </a>
                <a href="/facturador/public/pedido" class="nav-link flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-shopping-cart w-6 mr-3"></i> <span class="sidebar-text">Pedidos</span>
                </a>
            </nav>
            <div class="mt-auto text-xs text-gray-400 text-center sidebar-footer-text">
                <p>&copy; <?php echo date('Y'); ?> Facturador-GIACA.</p>
                <p>Todos los derechos reservados.</p>
            </div>
        </aside>