/**
 * NovaUI - Navegación
 * Script para manejar la navegación, menú móvil y sidebar colapsable
 */

(function() {
    // Elementos DOM
    const menuToggle = document.querySelector('.menu-toggle');
    const primaryMenu = document.querySelector('.main-navigation ul');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.dashboard-sidebar');
    const siteNavigation = document.querySelector('.main-navigation');
    
    /**
     * Maneja la apertura y cierre del menú móvil principal
     */
    function setupMobileMenu() {
        // Si no existe el botón de toggle o el menú, salir
        if (!menuToggle || !primaryMenu) return;
        
        // Esconder el menú inicialmente
        primaryMenu.setAttribute('aria-expanded', 'false');
        
        if (primaryMenu.classList.contains('nav-menu')) {
            primaryMenu.classList.add('nav-menu');
        }
        
        // Event listener para toggle
        menuToggle.addEventListener('click', function() {
            // Toggle para el menú
            primaryMenu.classList.toggle('toggled');
            
            // Actualizar ARIA states
            if (primaryMenu.classList.contains('toggled')) {
                menuToggle.setAttribute('aria-expanded', 'true');
                primaryMenu.setAttribute('aria-expanded', 'true');
            } else {
                menuToggle.setAttribute('aria-expanded', 'false');
                primaryMenu.setAttribute('aria-expanded', 'false');
            }
        });
    }
    
    /**
     * Maneja el colapso y expansión de la barra lateral en el dashboard
     */
    function setupSidebar() {
        // Si no existe el botón de toggle o la sidebar, salir
        if (!sidebarToggle || !sidebar) return;
        
        // Event listener para toggle
        sidebarToggle.addEventListener('click', function() {
            // Toggle para la barra lateral
            sidebar.classList.toggle('collapsed');
            
            // Actualizar ARIA states y clases
            if (sidebar.classList.contains('collapsed')) {
                sidebarToggle.setAttribute('aria-expanded', 'false');
                sidebarToggle.setAttribute('title', 'Expandir sidebar');
                document.body.classList.add('sidebar-collapsed');
            } else {
                sidebarToggle.setAttribute('aria-expanded', 'true');
                sidebarToggle.setAttribute('title', 'Colapsar sidebar');
                document.body.classList.remove('sidebar-collapsed');
            }
            
            // Guardar preferencia del usuario
            localStorage.setItem('novaui-sidebar-state', 
                sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded');
        });
        
        // Aplicar el estado guardado de la sidebar al cargar
        const savedState = localStorage.getItem('novaui-sidebar-state');
        if (savedState === 'collapsed') {
            sidebar.classList.add('collapsed');
            sidebarToggle.setAttribute('aria-expanded', 'false');
            sidebarToggle.setAttribute('title', 'Expandir sidebar');
            document.body.classList.add('sidebar-collapsed');
        } else {
            sidebar.classList.remove('collapsed');
            sidebarToggle.setAttribute('aria-expanded', 'true');
            sidebarToggle.setAttribute('title', 'Colapsar sidebar');
            document.body.classList.remove('sidebar-collapsed');
        }
    }
    
    /**
     * Permite navegación con teclado en menús desplegables
     */
    function setupKeyboardNavigation() {
        if (!siteNavigation) return;
        
        // Encontrar todos los enlaces del menú
        const links = siteNavigation.getElementsByTagName('a');
        const linksWithChildren = siteNavigation.querySelectorAll('.menu-item-has-children > a');
        
        // Agregar event listeners para navegación con teclado
        Array.from(linksWithChildren).forEach(link => {
            link.addEventListener('keydown', function(e) {
                const menu = this.parentNode.querySelector('.sub-menu');
                
                if (!menu) return;
                
                // Tecla de espacio o enter
                if (e.keyCode === 32 || e.keyCode === 13) {
                    e.preventDefault();
                    
                    // Toggle sub-menu
                    if (menu.classList.contains('toggled-on')) {
                        menu.classList.remove('toggled-on');
                        link.setAttribute('aria-expanded', 'false');
                    } else {
                        menu.classList.add('toggled-on');
                        link.setAttribute('aria-expanded', 'true');
                    }
                }
            });
        });
        
        // Cerrar submenús cuando se pierde el foco
        document.addEventListener('click', function(event) {
            if (!siteNavigation.contains(event.target)) {
                // Cerrar todos los submenús
                siteNavigation.querySelectorAll('.sub-menu.toggled-on').forEach(menu => {
                    menu.classList.remove('toggled-on');
                    menu.parentNode.querySelector('a').setAttribute('aria-expanded', 'false');
                });
            }
        });
    }
    
    /**
     * Setup para submenús desplegables
     */
    function setupDropdownMenus() {
        // Obtener todos los elementos del menú con sub-menús
        const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');
        
        menuItemsWithChildren.forEach(item => {
            // Agregar ícono de flecha
            const link = item.querySelector('a');
            const arrow = document.createElement('span');
            arrow.classList.add('dropdown-toggle');
            arrow.setAttribute('aria-hidden', 'true');
            link.appendChild(arrow);
            
            // Establecer ARIA
            link.setAttribute('aria-haspopup', 'true');
            link.setAttribute('aria-expanded', 'false');
            
            // Agregar event listener para clic
            arrow.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const parent = this.parentNode.parentNode;
                const subMenu = parent.querySelector('.sub-menu');
                
                if (subMenu) {
                    // Toggle para sub-menú
                    if (subMenu.classList.contains('toggled-on')) {
                        subMenu.classList.remove('toggled-on');
                        link.setAttribute('aria-expanded', 'false');
                    } else {
                        // Cerrar otros sub-menús primero
                        menuItemsWithChildren.forEach(otherItem => {
                            if (otherItem !== parent) {
                                const otherSubMenu = otherItem.querySelector('.sub-menu');
                                const otherLink = otherItem.querySelector('a');
                                if (otherSubMenu && otherSubMenu.classList.contains('toggled-on')) {
                                    otherSubMenu.classList.remove('toggled-on');
                                    otherLink.setAttribute('aria-expanded', 'false');
                                }
                            }
                        });
                        
                        subMenu.classList.add('toggled-on');
                        link.setAttribute('aria-expanded', 'true');
                    }
                }
            });
        });
    }
    
    /**
     * Maneja los menús desplegables en la interfaz de dashboard
     */
    function setupDashboardMenus() {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                
                const dropdown = this.nextElementSibling;
                
                // Cerrar todos los otros dropdowns primero
                dropdownToggles.forEach(otherToggle => {
                    if (otherToggle !== this) {
                        const otherDropdown = otherToggle.nextElementSibling;
                        if (otherDropdown && otherDropdown.classList.contains('show')) {
                            otherDropdown.classList.remove('show');
                            otherToggle.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
                
                // Toggle el dropdown actual
                if (dropdown) {
                    dropdown.classList.toggle('show');
                    this.setAttribute('aria-expanded', dropdown.classList.contains('show'));
                }
            });
        });
        
        // Cerrar dropdowns cuando se hace clic fuera
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown-toggle')) {
                dropdownToggles.forEach(toggle => {
                    const dropdown = toggle.nextElementSibling;
                    if (dropdown && dropdown.classList.contains('show')) {
                        dropdown.classList.remove('show');
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    }
    
    /**
     * Inicializar todos los componentes de navegación
     */
    function initNavigation() {
        setupMobileMenu();
        setupSidebar();
        setupKeyboardNavigation();
        setupDropdownMenus();
        setupDashboardMenus();
    }
    
    // Iniciar cuando el DOM esté cargado
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNavigation);
    } else {
        initNavigation();
    }
    
    // Exponer funciones para uso público
    window.novaUI = window.novaUI || {};
    window.novaUI.navigation = {
        initMobileMenu: setupMobileMenu,
        initSidebar: setupSidebar,
        initKeyboardNav: setupKeyboardNavigation,
        initDropdowns: setupDropdownMenus
    };
})();
