/**
 * Script para gestionar la funcionalidad del sidebar colapsable
 * y la navegación del dashboard
 */

(function() {
    'use strict';
    
    // Referencias a elementos DOM
    const sidebar = document.querySelector('.dashboard-sidebar');
    const collapseButton = document.querySelector('.sidebar-collapse-btn');
    const navLinks = document.querySelectorAll('.dashboard-nav-link');
    const mainContent = document.querySelector('.dashboard-main');
    
    // Nombre de la cookie para guardar el estado del sidebar
    const SIDEBAR_STATE_COOKIE = 'novaui_sidebar_collapsed';
    
    /**
     * Establecer una cookie con el estado del sidebar
     */
    function setSidebarStateCookie(isCollapsed) {
        const date = new Date();
        date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000)); // Expira en un año
        const expires = "expires=" + date.toUTCString();
        document.cookie = SIDEBAR_STATE_COOKIE + "=" + isCollapsed + ";" + expires + ";path=/";
    }
    
    /**
     * Obtener el valor de la cookie para el estado del sidebar
     */
    function getSidebarStateCookie() {
        const name = SIDEBAR_STATE_COOKIE + "=";
        const decodedCookie = decodeURIComponent(document.cookie);
        const cookieArray = decodedCookie.split(';');
        
        for (let i = 0; i < cookieArray.length; i++) {
            let cookie = cookieArray[i].trim();
            if (cookie.indexOf(name) === 0) {
                return cookie.substring(name.length, cookie.length) === 'true';
            }
        }
        
        return false; // Por defecto, no colapsado
    }
    
    /**
     * Cambiar el estado del sidebar entre colapsado y expandido
     */
    function toggleSidebar() {
        if (sidebar) {
            sidebar.classList.toggle('collapsed');
            const isCollapsed = sidebar.classList.contains('collapsed');
            setSidebarStateCookie(isCollapsed);
            
            // Cambiar el icono del botón de colapso
            if (collapseButton) {
                const iconElement = collapseButton.querySelector('i, svg');
                if (iconElement) {
                    if (isCollapsed) {
                        iconElement.classList.remove('fa-chevron-left');
                        iconElement.classList.add('fa-chevron-right');
                    } else {
                        iconElement.classList.remove('fa-chevron-right');
                        iconElement.classList.add('fa-chevron-left');
                    }
                }
            }
        }
    }
    
    /**
     * Marcar el enlace de navegación activo según la URL actual
     */
    function setActiveNavLink() {
        if (navLinks && navLinks.length) {
            const currentPath = window.location.pathname;
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                
                const linkPath = link.getAttribute('href');
                
                // Verificar si la URL actual coincide con el enlace
                if (linkPath && currentPath === linkPath) {
                    link.classList.add('active');
                }
                // También verificar para páginas secundarias (por ejemplo, /dashboard/stats/)
                else if (linkPath && currentPath.startsWith(linkPath) && linkPath !== '/') {
                    link.classList.add('active');
                }
            });
        }
    }
    
    /**
     * Inicializar el estado del sidebar desde la cookie guardada
     */
    function initializeSidebarState() {
        const isCollapsed = getSidebarStateCookie();
        
        if (isCollapsed && sidebar) {
            sidebar.classList.add('collapsed');
            
            // Actualizar el icono del botón de colapso
            if (collapseButton) {
                const iconElement = collapseButton.querySelector('i, svg');
                if (iconElement) {
                    iconElement.classList.remove('fa-chevron-left');
                    iconElement.classList.add('fa-chevron-right');
                }
            }
        }
    }
    
    /**
     * Mostrar tooltips para íconos en el sidebar colapsado
     */
    function setupTooltips() {
        if (navLinks && navLinks.length) {
            navLinks.forEach(link => {
                // Obtener el texto y el ícono del enlace
                const linkText = link.querySelector('.dashboard-nav-text')?.textContent?.trim();
                const iconElement = link.querySelector('.dashboard-nav-icon');
                
                if (linkText && iconElement) {
                    // Añadir atributo title para mostrar tooltip al pasar el mouse
                    iconElement.setAttribute('title', linkText);
                }
            });
        }
    }
    
    /**
     * Configurar escuchadores de eventos para el sidebar
     */
    function setupEventListeners() {
        // Escuchador para botón de colapso
        if (collapseButton) {
            collapseButton.addEventListener('click', toggleSidebar);
        }
        
        // Escuchador para enlaces de navegación
        if (navLinks && navLinks.length) {
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Quitar la clase activa de todos los enlaces
                    navLinks.forEach(l => l.classList.remove('active'));
                    // Añadir la clase activa al enlace clickeado
                    this.classList.add('active');
                });
            });
        }
    }
    
    // Iniciar cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', () => {
        if (sidebar) {
            initializeSidebarState();
            setActiveNavLink();
            setupTooltips();
            setupEventListeners();
        }
    });
    
})();
