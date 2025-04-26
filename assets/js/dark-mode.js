/**
 * NovaUI Theme - Dark Mode Toggle
 * 
 * Este script gestiona el cambio entre modo claro y oscuro
 * con detección automática de preferencias del sistema y 
 * guardado de preferencia del usuario en cookies.
 */

(function() {
    // Elementos DOM
    const themeToggle = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;
    const bodyElement = document.body;
    
    // Duración de la cookie (1 mes)
    const COOKIE_DURATION = 30;
    
    // Obtener el modo preferido (del sistema o cookie guardada)
    function getPreferredMode() {
        // Verificar si hay una preferencia guardada en cookie
        const savedMode = getCookie('theme_mode');
        if (savedMode) {
            return savedMode;
        }
        
        // Si no hay preferencia guardada, detectar preferencia del sistema
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return 'dark';
        }
        
        // Por defecto, modo claro
        return 'light';
    }
    
    // Establecer el modo del tema
    function setThemeMode(mode) {
        if (mode === 'dark') {
            htmlElement.classList.add('dark-mode');
            bodyElement.classList.add('dark-mode');
            htmlElement.classList.remove('light-mode');
            bodyElement.classList.remove('light-mode');
            // Guardar preferencia en cookie
            setCookie('theme_mode', 'dark', COOKIE_DURATION);
        } else {
            htmlElement.classList.add('light-mode');
            bodyElement.classList.add('light-mode');
            htmlElement.classList.remove('dark-mode');
            bodyElement.classList.remove('dark-mode');
            // Guardar preferencia en cookie
            setCookie('theme_mode', 'light', COOKIE_DURATION);
        }
    }
    
    // Alternar entre modos claro y oscuro
    function toggleThemeMode() {
        if (htmlElement.classList.contains('dark-mode')) {
            setThemeMode('light');
        } else {
            setThemeMode('dark');
        }
    }
    
    // Funciones para gestionar cookies
    function setCookie(name, value, days) {
        let expires = '';
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        document.cookie = name + '=' + value + expires + '; path=/; SameSite=Lax';
    }
    
    function getCookie(name) {
        const nameEQ = name + '=';
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1, c.length);
            }
            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length, c.length);
            }
        }
        return null;
    }
    
    // Inicializar el tema al cargar la página
    function initializeTheme() {
        const preferredMode = getPreferredMode();
        setThemeMode(preferredMode);
        
        // Añadir listeners para cambios de preferencia del sistema
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                // Sólo cambiar automáticamente si no hay preferencia guardada
                if (!getCookie('theme_mode')) {
                    setThemeMode(e.matches ? 'dark' : 'light');
                }
            });
        }
    }
    
    // Añadir event listener al botón de cambio de tema
    if (themeToggle) {
        themeToggle.addEventListener('click', toggleThemeMode);
    } else {
        // Si no existe el botón de toggle, crear uno para documentación/testing
        console.info('NovaUI: Dark mode toggle button not found. Adding listeners to any element with class "theme-toggle".');
        
        // Buscar elementos con clase theme-toggle
        const toggleButtons = document.querySelectorAll('.theme-toggle');
        toggleButtons.forEach(button => {
            button.addEventListener('click', toggleThemeMode);
        });
    }
    
    // Inicializar cuando el DOM esté cargado
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeTheme);
    } else {
        initializeTheme();
    }
})();
