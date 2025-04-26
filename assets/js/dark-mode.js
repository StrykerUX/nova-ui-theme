/**
 * Manejo del tema oscuro/claro - NovaUI Theme
 */
(function() {
    'use strict';

    // Elementos del DOM
    const darkModeToggles = document.querySelectorAll('.saas-dark-mode-toggle, #dark-mode-toggle');
    const html = document.documentElement;
    
    // Estado del tema
    let darkMode = localStorage.getItem('novauiDarkMode');
    
    // Función para aplicar el tema
    const applyTheme = () => {
        if (darkMode === 'dark') {
            html.classList.add('dark-mode');
        } else if (darkMode === 'light') {
            html.classList.remove('dark-mode');
        } else {
            // Si no hay preferencia guardada, usar la preferencia del sistema
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (prefersDark) {
                html.classList.add('dark-mode');
            } else {
                html.classList.remove('dark-mode');
            }
        }
    };
    
    // Función para cambiar el tema
    const toggleDarkMode = () => {
        if (html.classList.contains('dark-mode')) {
            html.classList.remove('dark-mode');
            localStorage.setItem('novauiDarkMode', 'light');
            darkMode = 'light';
        } else {
            html.classList.add('dark-mode');
            localStorage.setItem('novauiDarkMode', 'dark');
            darkMode = 'dark';
        }
    };
    
    // Aplicar el tema al cargar la página
    applyTheme();
    
    // Agregar event listeners a los toggles
    darkModeToggles.forEach(toggle => {
        toggle.addEventListener('click', toggleDarkMode);
    });
    
    // Escuchar cambios en la preferencia del sistema
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        if (darkMode !== 'dark' && darkMode !== 'light') {
            // Solo aplicar si el usuario no ha establecido una preferencia manual
            if (event.matches) {
                html.classList.add('dark-mode');
            } else {
                html.classList.remove('dark-mode');
            }
        }
    });
    
    // Exponer funciones para uso de otros scripts
    window.novaUIDarkMode = {
        toggle: toggleDarkMode,
        apply: applyTheme
    };
})();
