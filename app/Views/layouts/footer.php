</div>
<script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Estado inicial del sidebar (leer de localStorage si existe)
        let isSidebarExpanded = localStorage.getItem('sidebarExpanded') === 'true';
        if (isSidebarExpanded === null) { // Si no hay nada en localStorage, por defecto expandido
            isSidebarExpanded = true;
        }


        function applySidebarState() {
            if (isSidebarExpanded) {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
                mainContent.classList.remove('content-collapsed');
                mainContent.classList.add('content-expanded');
            } else {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                mainContent.classList.remove('content-expanded');
                mainContent.classList.add('content-collapsed');
            }
        }

        sidebarToggle.addEventListener('click', () => {
            isSidebarExpanded = !isSidebarExpanded;
            localStorage.setItem('sidebarExpanded', isSidebarExpanded);
            applySidebarState();
        });

        // Aplicar estado al cargar la página
        applySidebarState();
    </script>
</body>
</html>