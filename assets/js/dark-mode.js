/**
 * Dark Mode Script - NovaUI Theme
 * 
 * Maneja la funcionalidad de cambio entre tema claro y oscuro
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elementos para toggle de tema oscuro/claro
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const html = document.documentElement;
    
    // Función para cambiar modo y guardar preferencia
    function setDarkMode(mode) {
        if (mode === 'dark') {
            html.classList.add('dark-mode');
        } else {
            html.classList.remove('dark-mode');
        }
        
        // Guardar preferencia en cookie usando AJAX
        const formData = new FormData();
        formData.append('action', 'nova_ui_set_dark_mode');
        formData.append('mode', mode);
        
        fetch(novaUISettings.ajaxurl, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        }).catch(error => {
            console.error('Error al guardar preferencia de tema:', error);
        });
    }
    
    // Si existe el botón de toggle, añadir evento de click
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            if (html.classList.contains('dark-mode')) {
                setDarkMode('light');
            } else {
                setDarkMode('dark');
            }
        });
    }
    
    // Inicializar modo según preferencia guardada o del sistema
    function initDarkMode() {
        const savedMode = getCookie('nova_ui_dark_mode');
        
        if (savedMode === 'dark') {
            setDarkMode('dark');
        } else if (savedMode === 'light') {
            setDarkMode('light');
        } else {
            // Si no hay preferencia guardada, detectar preferencia del sistema
            const prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (prefersDarkMode) {
                setDarkMode('dark');
            } else {
                setDarkMode('light');
            }
        }
    }
    
    // Función para obtener valor de cookie
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return '';
    }
    
    // Escuchar cambios en preferencia del sistema
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        const savedMode = getCookie('nova_ui_dark_mode');
        // Solo cambiar automáticamente si no hay preferencia guardada
        if (savedMode !== 'dark' && savedMode !== 'light') {
            if (e.matches) {
                setDarkMode('dark');
            } else {
                setDarkMode('light');
            }
        }
    });
    
    // Inicializar
    initDarkMode();
});
