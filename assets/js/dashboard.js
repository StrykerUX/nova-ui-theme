/**
 * NovaUI - Dashboard JavaScript
 * Controlador para funciones interactivas del dashboard
 */

document.addEventListener('DOMContentLoaded', function() {
    // Toggle de sidebar colapsable
    const sidebarToggleBtn = document.querySelector('.sidebar-toggle');
    const dashboardSidebar = document.querySelector('.dashboard-sidebar');
    
    if (sidebarToggleBtn && dashboardSidebar) {
        sidebarToggleBtn.addEventListener('click', function() {
            dashboardSidebar.classList.toggle('collapsed');
            
            // Actualizar aria-expanded
            const isExpanded = !dashboardSidebar.classList.contains('collapsed');
            sidebarToggleBtn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            
            // Guardar preferencia en localStorage
            localStorage.setItem('nova_ui_sidebar_collapsed', dashboardSidebar.classList.contains('collapsed'));
        });
        
        // Comprobar si hay una preferencia guardada
        const sidebarCollapsed = localStorage.getItem('nova_ui_sidebar_collapsed') === 'true';
        if (sidebarCollapsed) {
            dashboardSidebar.classList.add('collapsed');
            sidebarToggleBtn.setAttribute('aria-expanded', 'false');
        }
    }
    
    // Toggle del menú de usuario
    const userToggleBtn = document.querySelector('.dashboard-user-toggle');
    const userDropdown = document.querySelector('.dashboard-user-dropdown');
    
    if (userToggleBtn && userDropdown) {
        userToggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            userDropdown.classList.toggle('active');
            
            // Actualizar aria-expanded
            const isExpanded = userDropdown.classList.contains('active');
            userToggleBtn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        });
        
        // Cerrar el menú si se hace clic fuera de él
        document.addEventListener('click', function(e) {
            if (!userToggleBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('active');
                userToggleBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }
    
    // Toggle del menú móvil
    const mobileToggleBtn = document.querySelector('.dashboard-mobile-menu-toggle');
    
    if (mobileToggleBtn && dashboardSidebar) {
        mobileToggleBtn.addEventListener('click', function() {
            dashboardSidebar.classList.toggle('active');
        });
    }
    
    // Dark mode toggle
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            
            // Guardar preferencia
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('nova_ui_dark_mode', isDarkMode ? 'dark' : 'light');
            
            // Si WordPress está activado, también enviar AJAX
            if (typeof novaUISettings !== 'undefined') {
                fetch(novaUISettings.ajaxurl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=nova_ui_set_dark_mode&mode=' + (isDarkMode ? 'dark' : 'light')
                });
            }
        });
    }
});
