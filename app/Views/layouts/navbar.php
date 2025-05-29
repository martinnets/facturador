<header class="bg-white shadow-md p-4 sticky top-0 z-10">
                <div class="flex items-center justify-between">
                    <button id="sidebarToggle" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                    
                    <div class="text-xl font-semibold text-gray-700">
                        <?php echo isset($title) ? htmlspecialchars($title) : 'Modulo Facturador - GIACA'; ?>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell"></i>
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-600 hover:text-gray-800">
                                <img src="https://placehold.co/32x32/E0E0E0/B0B0B0?text=User" alt="[Imagen de Perfil de Usuario]" class="w-8 h-8 rounded-full mr-2">
                                <span class="hidden md:inline">Usuario</span>
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </button>
                            <!-- 
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 hidden">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mi Perfil</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Configuración</a>
                                <hr>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar Sesión</a>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </header>