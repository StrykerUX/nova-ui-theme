/**
 * NovaUI Theme - Navegación
 * 
 * Este script gestiona la navegación principal, el menú de usuario y 
 * la navegación del dashboard (sidebar colapsable).
 */

(function() {
    // Navegación Principal
    function initMainNavigation() {
        const mainNav = document.querySelector('.main-navigation');
        const menuToggle = document.querySelector('.menu-toggle');
        
        if (menuToggle && mainNav) {
            menuToggle.addEventListener('click', function() {
                mainNav.classList.toggle('toggled');
                
                const expanded = mainNav.classList.contains('toggled');
                menuToggle.setAttribute('aria-expanded', expanded);
            });
        }
    }
    
    // Menú de Usuario
    function initUserMenu() {
        const userMenuToggle = document.querySelector('.user-menu-toggle');
        const userDropdown = document.querySelector('.user-dropdown');
        
        if (userMenuToggle && userDropdown) {
            userMenuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                userDropdown.classList.toggle('active');
                
                // Cerrar el menú cuando se hace clic fuera de él
                document.addEventListener('click', function closeMenu(event) {
                    if (!userDropdown.contains(event.target) && !userMenuToggle.contains(event.target)) {
                        userDropdown.classList.remove('active');
                        document.removeEventListener('click', closeMenu);
                    }
                });
            });
        }
    }
    
    // Navegación del Dashboard
    function initDashboardNavigation() {
        const toggleSidebar = document.querySelector('.dashboard-toggle-sidebar');
        const dashboardSidebar = document.querySelector('.dashboard-sidebar');
        const overlay = document.querySelector('.dashboard-overlay');
        
        if (toggleSidebar && dashboardSidebar) {
            // Alternar estado colapsado del sidebar
            toggleSidebar.addEventListener('click', function() {
                dashboardSidebar.classList.toggle('collapsed');
                
                // Guardar el estado del sidebar en localStorage
                const collapsed = dashboardSidebar.classList.contains('collapsed');
                localStorage.setItem('dashboard_sidebar_collapsed', collapsed ? 'true' : 'false');
            });
            
            // Restaurar el estado del sidebar desde localStorage
            if (localStorage.getItem('dashboard_sidebar_collapsed') === 'true') {
                dashboardSidebar.classList.add('collapsed');
            }
            
            // En móvil, cerrar el sidebar al hacer clic en el overlay
            if (overlay) {
                overlay.addEventListener('click', function() {
                    dashboardSidebar.classList.add('collapsed');
                });
            }
            
            // Detectar cambios de tamaño de ventana
            window.addEventListener('resize', function() {
                if (window.innerWidth <= 991) {
                    // En móvil, asegurarse de que exista el overlay
                    if (!overlay) {
                        const newOverlay = document.createElement('div');
                        newOverlay.className = 'dashboard-overlay';
                        document.body.appendChild(newOverlay);
                        
                        newOverlay.addEventListener('click', function() {
                            dashboardSidebar.classList.add('collapsed');
                        });
                    }
                } else {
                    // En desktop, eliminar el overlay si existe
                    if (overlay) {
                        overlay.remove();
                    }
                }
            });
        }
    }
    
    // Marcar el elemento activo en la navegación del Dashboard
    function setActiveNavItem() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.dashboard-nav-link');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            
            // Comparar la URL actual con el href del enlace
            if (href === currentPath || (currentPath.includes(href) && href !== '/')) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }
    
    // Inicializar las acciones del header del dashboard
    function initDashboardHeaderActions() {
        const userToggle = document.querySelector('.dashboard-user');
        const userDropdown = document.querySelector('.dashboard-user-dropdown');
        
        if (userToggle && userDropdown) {
            userToggle.addEventListener('click', function() {
                userDropdown.classList.toggle('active');
                
                // Cerrar el menú cuando se hace clic fuera de él
                document.addEventListener('click', function closeMenu(event) {
                    if (!userDropdown.contains(event.target) && !userToggle.contains(event.target)) {
                        userDropdown.classList.remove('active');
                        document.removeEventListener('click', closeMenu);
                    }
                });
            });
        }
    }
    
    // Inicializar todos los componentes de navegación
    function initNavigation() {
        initMainNavigation();
        initUserMenu();
        
        // Inicializar navegación de dashboard si estamos en esa plantilla
        if (document.body.classList.contains('dashboard-layout')) {
            initDashboardNavigation();
            setActiveNavItem();
            initDashboardHeaderActions();
        }
    }
    
    // Inicializar cuando el DOM esté cargado
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNavigation);
    } else {
        initNavigation();
    }
})();
