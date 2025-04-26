/**
 * NovaUI - Dark Mode Toggle
 * Script para manejar el cambio entre tema claro y oscuro
 */

(function() {
    // Elementos del DOM
    const body = document.documentElement;
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const darkModeClass = 'dark-mode';
    const lightModeClass = 'light-mode';
    const storageKey = 'novaui-theme-mode';
    
    /**
     * Obtiene la preferencia del usuario desde localStorage o del sistema
     * @returns {string} 'dark', 'light', o 'auto'
     */
    function getUserPreference() {
        // Verificar si hay una preferencia guardada
        const savedMode = localStorage.getItem(storageKey);
        if (savedMode) {
            return savedMode;
        }
        
        // Si no hay preferencia guardada, detectar preferencia del sistema
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return 'dark';
        }
        
        return 'light'; // Por defecto modo claro
    }
    
    /**
     * Aplica el modo (claro/oscuro) a la UI
     * @param {string} mode - 'dark', 'light', o 'auto'
     */
    function applyTheme(mode) {
        // Eliminar clases existentes
        body.classList.remove(darkModeClass, lightModeClass);
        
        // Si es auto, usar preferencia del sistema
        if (mode === 'auto') {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                body.classList.add(darkModeClass);
                updateToggleButton('dark');
            } else {
                body.classList.add(lightModeClass);
                updateToggleButton('light');
            }
            localStorage.removeItem(storageKey); // Elimina para usar auto
            return;
        }
        
        // Aplicar el modo específico
        if (mode === 'dark') {
            body.classList.add(darkModeClass);
        } else {
            body.classList.add(lightModeClass);
        }
        
        // Guardar preferencia del usuario
        localStorage.setItem(storageKey, mode);
        
        // Actualizar estado visual del botón
        updateToggleButton(mode);
    }
    
    /**
     * Actualiza el estado visual del botón de toggle
     * @param {string} mode - 'dark' o 'light'
     */
    function updateToggleButton(mode) {
        // Solo continuar si el botón existe en la página
        if (!darkModeToggle) return;
        
        // Actualizar aria-label y clases del botón
        if (mode === 'dark') {
            darkModeToggle.setAttribute('aria-label', 'Cambiar a modo claro');
            darkModeToggle.setAttribute('title', 'Cambiar a modo claro');
            darkModeToggle.classList.add('is-dark');
            darkModeToggle.classList.remove('is-light');
            
            // Actualizar iconos si usan clases
            const icons = darkModeToggle.querySelectorAll('.icon-moon, .icon-sun');
            icons.forEach(icon => {
                if (icon.classList.contains('icon-moon')) {
                    icon.style.display = 'none';
                } else if (icon.classList.contains('icon-sun')) {
                    icon.style.display = 'block';
                }
            });
        } else {
            darkModeToggle.setAttribute('aria-label', 'Cambiar a modo oscuro');
            darkModeToggle.setAttribute('title', 'Cambiar a modo oscuro');
            darkModeToggle.classList.add('is-light');
            darkModeToggle.classList.remove('is-dark');
            
            // Actualizar iconos si usan clases
            const icons = darkModeToggle.querySelectorAll('.icon-moon, .icon-sun');
            icons.forEach(icon => {
                if (icon.classList.contains('icon-moon')) {
                    icon.style.display = 'block';
                } else if (icon.classList.contains('icon-sun')) {
                    icon.style.display = 'none';
                }
            });
        }
    }
    
    /**
     * Alterna entre modo claro y oscuro
     */
    function toggleTheme() {
        const currentMode = body.classList.contains(darkModeClass) ? 'dark' : 'light';
        const newMode = currentMode === 'dark' ? 'light' : 'dark';
        applyTheme(newMode);
    }
    
    /**
     * Inicializa el sistema de temas
     */
    function initThemeSystem() {
        // Aplicar tema inicial basado en preferencia
        const userPreference = getUserPreference();
        applyTheme(userPreference);
        
        // Agregar listeners para cambios en preferencias del sistema
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                if (localStorage.getItem(storageKey) === null) {
                    // Solo aplicar si está en modo auto (no hay preferencia guardada)
                    applyTheme(e.matches ? 'dark' : 'light');
                }
            });
        }
        
        // Agregar event listener al botón de toggle si existe
        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', toggleTheme);
        }
    }
    
    // Iniciar cuando el DOM esté cargado
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initThemeSystem);
    } else {
        initThemeSystem();
    }
    
    // Exponer funciones para uso público
    window.novaUI = window.novaUI || {};
    window.novaUI.themes = {
        toggle: toggleTheme,
        apply: applyTheme,
        getPreference: getUserPreference
    };
})();
