/**
 * Script para cambiar entre tema claro y oscuro
 * Con soporte para detectar preferencias del sistema y guardar la selección
 */

(function() {
    'use strict';
    
    // Referencias a elementos DOM
    const themeToggleButtons = document.querySelectorAll('.theme-toggle-btn');
    const html = document.documentElement;
    const body = document.body;
    
    // Opciones de tema
    const THEME_LIGHT = 'light';
    const THEME_DARK = 'dark';
    const THEME_AUTO = 'auto';
    
    // Nombre de la cookie para guardar la preferencia
    const COOKIE_NAME = 'novaui_dark_mode';
    
    /**
     * Verificar si el usuario prefiere el tema oscuro según su sistema
     */
    function userPrefersDarkMode() {
        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    }
    
    /**
     * Establecer una cookie con la preferencia del usuario
     */
    function setCookie(value, days = 365) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = COOKIE_NAME + "=" + value + ";" + expires + ";path=/";
    }
    
    /**
     * Obtener el valor de la cookie
     */
    function getCookie() {
        const name = COOKIE_NAME + "=";
        const decodedCookie = decodeURIComponent(document.cookie);
        const cookieArray = decodedCookie.split(';');
        
        for (let i = 0; i < cookieArray.length; i++) {
            let cookie = cookieArray[i].trim();
            if (cookie.indexOf(name) === 0) {
                return cookie.substring(name.length, cookie.length);
            }
        }
        
        return '';
    }
    
    /**
     * Aplicar el tema oscuro
     */
    function applyDarkMode() {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
        setCookie('true');
    }
    
    /**
     * Aplicar el tema claro
     */
    function applyLightMode() {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        setCookie('false');
    }
    
    /**
     * Cambiar el tema activo
     */
    function toggleTheme() {
        if (body.classList.contains('dark-mode')) {
            applyLightMode();
        } else {
            applyDarkMode();
        }
    }
    
    /**
     * Inicializar el tema según la configuración
     */
    function initializeTheme() {
        // Obtener el tema predeterminado de la configuración del tema (definido en PHP)
        const defaultThemeMode = window.novaUI?.defaultThemeMode || THEME_AUTO;
        
        // Obtener la preferencia guardada en la cookie
        const savedPreference = getCookie();
        
        if (defaultThemeMode === THEME_DARK) {
            // Si el tema predeterminado es oscuro
            applyDarkMode();
        } else if (defaultThemeMode === THEME_LIGHT) {
            // Si el tema predeterminado es claro
            applyLightMode();
        } else {
            // Si es automático, verificar preferencia guardada o preferencia del sistema
            if (savedPreference === 'true') {
                applyDarkMode();
            } else if (savedPreference === 'false') {
                applyLightMode();
            } else if (userPrefersDarkMode()) {
                applyDarkMode();
            } else {
                applyLightMode();
            }
        }
    }
    
    /**
     * Añadir escuchadores de eventos
     */
    function setupEventListeners() {
        // Escuchador para botones de cambio de tema
        themeToggleButtons.forEach(button => {
            button.addEventListener('click', toggleTheme);
        });
        
        // Escuchador para cambios en la preferencia del sistema
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            // Solo cambiar automáticamente si no hay preferencia guardada
            if (!getCookie()) {
                if (e.matches) {
                    applyDarkMode();
                } else {
                    applyLightMode();
                }
            }
        });
    }
    
    // Iniciar cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', () => {
        initializeTheme();
        setupEventListeners();
    });
    
})();
