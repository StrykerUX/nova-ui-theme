/**
 * Script para manejar el cambio entre modo claro y oscuro
 * 
 * @package NovaUI
 */

(function() {
    document.addEventListener('DOMContentLoaded', function() {
        // Elementos que togglean el tema
        const themeSwitchers = document.querySelectorAll('#theme-switcher, .theme-toggle-btn');
        
        // Función para detectar preferencia del sistema
        function isSystemDarkMode() {
            return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        }
        
        // Función para detectar preferencia guardada
        function isSavedDarkMode() {
            return localStorage.getItem('novaui_dark_mode') === 'true';
        }
        
        // Función para determinar si se debe usar modo oscuro
        function shouldUseDarkMode() {
            // Primero checar si hay una preferencia guardada
            if (localStorage.getItem('novaui_dark_mode') !== null) {
                return isSavedDarkMode();
            }
            
            // Si no hay preferencia guardada, usar la del sistema
            return isSystemDarkMode();
        }
        
        // Función para aplicar el modo oscuro/claro
        function applyTheme() {
            const isDarkMode = shouldUseDarkMode();
            document.documentElement.classList.toggle('dark-mode', isDarkMode);
            document.body.classList.toggle('dark-mode', isDarkMode);
            
            // También actualizamos las cookies para PHP
            document.cookie = `novaui_dark_mode=${isDarkMode}; path=/; max-age=31536000`;
        }
        
        // Aplicar el tema al cargar la página
        applyTheme();
        
        // Función para cambiar el tema
        function toggleTheme() {
            const currentMode = isSavedDarkMode();
            localStorage.setItem('novaui_dark_mode', (!currentMode).toString());
            applyTheme();
        }
        
        // Eventos de click para los botones de cambio de tema
        themeSwitchers.forEach(function(switcher) {
            if (switcher) {
                switcher.addEventListener('click', toggleTheme);
            }
        });
        
        // Detectar cambios en la preferencia del sistema
        if (window.matchMedia) {
            const colorSchemeQuery = window.matchMedia('(prefers-color-scheme: dark)');
            
            colorSchemeQuery.addEventListener('change', function(e) {
                // Solo cambiar automáticamente si no hay preferencia guardada
                if (localStorage.getItem('novaui_dark_mode') === null) {
                    applyTheme();
                }
            });
        }
    });
})();
