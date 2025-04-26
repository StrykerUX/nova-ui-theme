/**
 * Controlador de modo oscuro/claro
 * Gestiona la preferencia del usuario para el tema oscuro o claro
 *
 * @package NovaUI
 */

(function() {
  'use strict';

  // Comprueba si el toggle del tema oscuro está habilitado
  const themeToggleEnabled = true; // Esto podría ser una variable PHP inyectada desde el servidor

  if (!themeToggleEnabled) {
    return;
  }

  // Obtener elementos DOM
  const themeToggle = document.getElementById('theme-toggle');
  const htmlElement = document.documentElement;
  
  // Comprobar si el navegador soporta localStorage
  const supportsLocalStorage = () => {
    try {
      localStorage.setItem('test', 'test');
      localStorage.removeItem('test');
      return true;
    } catch (e) {
      return false;
    }
  };

  // Comprobar si la preferencia del sistema es oscura
  const prefersDarkMode = () => {
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  };

  // Obtener preferencia guardada
  const getSavedTheme = () => {
    if (supportsLocalStorage()) {
      return localStorage.getItem('theme');
    }
    return null;
  };

  // Guardar preferencia
  const saveTheme = (theme) => {
    if (supportsLocalStorage()) {
      localStorage.setItem('theme', theme);
    }
  };

  // Establecer tema
  const setTheme = (theme) => {
    if (theme === 'dark') {
      htmlElement.classList.remove('light-mode', 'auto-mode');
      htmlElement.classList.add('dark-mode');
      document.dispatchEvent(new CustomEvent('novauiThemeChanged', { detail: { theme: 'dark' } }));
    } else if (theme === 'light') {
      htmlElement.classList.remove('dark-mode', 'auto-mode');
      htmlElement.classList.add('light-mode');
      document.dispatchEvent(new CustomEvent('novauiThemeChanged', { detail: { theme: 'light' } }));
    } else {
      // Auto (seguir sistema)
      htmlElement.classList.remove('light-mode', 'dark-mode');
      htmlElement.classList.add('auto-mode');
      document.dispatchEvent(new CustomEvent('novauiThemeChanged', { detail: { theme: 'auto' } }));
    }
  };

  // Alternar tema
  const toggleTheme = () => {
    if (htmlElement.classList.contains('dark-mode')) {
      setTheme('light');
      saveTheme('light');
    } else if (htmlElement.classList.contains('light-mode')) {
      setTheme('auto');
      saveTheme('auto');
    } else {
      setTheme('dark');
      saveTheme('dark');
    }
  };

  // Inicializar tema
  const initTheme = () => {
    const savedTheme = getSavedTheme();
    
    // Si no hay tema guardado, usar configuración del sistema
    if (!savedTheme) {
      setTheme('auto');
    } else {
      setTheme(savedTheme);
    }
  };

  // Añadir event listeners
  if (themeToggle) {
    themeToggle.addEventListener('click', toggleTheme);
  }

  // Detectar cambios en las preferencias del sistema
  if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
      if (htmlElement.classList.contains('auto-mode')) {
        // No hacer nada, el CSS se encarga de los cambios en auto mode
        document.dispatchEvent(new CustomEvent('novauiThemeChanged', { 
          detail: { 
            theme: 'auto', 
            systemPreference: e.matches ? 'dark' : 'light' 
          } 
        }));
      }
    });
  }

  // Inicializar al cargar la página
  document.addEventListener('DOMContentLoaded', initTheme);

})();
