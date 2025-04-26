/**
 * Script para manejar la funcionalidad del sidebar del dashboard
 * 
 * @package NovaUI
 */

(function() {
    document.addEventListener('DOMContentLoaded', function() {
        // Variables para los elementos del DOM
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        const sidebar = document.querySelector('.dashboard-sidebar');
        const content = document.querySelector('.dashboard-content');
        const header = document.querySelector('.dashboard-header');
        
        // Verificar si estamos en la vista dashboard
        if (!sidebar || !sidebarToggle) {
            return;
        }
        
        // Comprobar si hay una preferencia guardada para el estado del sidebar
        function isSidebarCollapsed() {
            return localStorage.getItem('novaui_sidebar_collapsed') === 'true';
        }
        
        // Aplicar estado guardado del sidebar
        function applySidebarState() {
            const isCollapsed = isSidebarCollapsed();
            sidebar.classList.toggle('collapsed', isCollapsed);
            
            // También ajustar el contenido principal y el header
            if (content) {
                content.classList.toggle('sidebar-collapsed', isCollapsed);
            }
            
            if (header) {
                header.classList.toggle('sidebar-collapsed', isCollapsed);
            }
        }
        
        // Aplicar estado al cargar la página
        applySidebarState();
        
        // Función para alternar el estado del sidebar
        function toggleSidebar() {
            const currentState = isSidebarCollapsed();
            localStorage.setItem('novaui_sidebar_collapsed', (!currentState).toString());
            applySidebarState();
        }
        
        // Evento de click para el botón de alternar sidebar
        sidebarToggle.addEventListener('click', toggleSidebar);
        
        // Funcionalidad para dispositivos móviles
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                document.body.classList.toggle('sidebar-open');
            });
            
            // Cerrar sidebar al hacer click fuera de él en móvil
            document.addEventListener('click', function(event) {
                const isMobile = window.innerWidth <= 768;
                
                if (isMobile && 
                    sidebar.classList.contains('active') && 
                    !sidebar.contains(event.target) && 
                    !menuToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                    document.body.classList.remove('sidebar-open');
                }
            });
        }
        
        // Active state para ítems de navegación
        const navLinks = document.querySelectorAll('.dashboard-nav-link');
        
        navLinks.forEach(function(link) {
            // Comprobar si el link actual corresponde a la página actual
            if (link.href === window.location.href || 
                window.location.href.indexOf(link.href) === 0) {
                link.classList.add('active');
            }
            
            // También añadir event listener para activar el link al hacer click
            link.addEventListener('click', function() {
                navLinks.forEach(function(l) {
                    l.classList.remove('active');
                });
                
                link.classList.add('active');
            });
        });
        
        // Ajustar sidebar para dispositivos móviles cuando la ventana cambia de tamaño
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('collapsed');
                localStorage.setItem('novaui_sidebar_collapsed', 'false');
            }
            applySidebarState();
        });
    });
})();
