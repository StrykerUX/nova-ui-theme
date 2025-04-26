/**
 * Archivo para manejar la navegación responsiva
 * Controla el menú de navegación principal y menú lateral
 *
 * @package NovaUI
 */

(function() {
  'use strict';

  // Variables para el menú de navegación principal
  const siteNavigation = document.getElementById('site-navigation');
  const menuToggle = document.querySelector('.menu-toggle');

  // Variables para el sidebar (menú lateral)
  const sidebar = document.querySelector('.sidebar');
  const sidebarToggle = document.querySelector('.sidebar-toggle');
  const mainContent = document.querySelector('.dashboard-content');

  /**
   * Menú de navegación principal para móviles
   */
  if (menuToggle) {
    menuToggle.addEventListener('click', function() {
      siteNavigation.classList.toggle('toggled');
      
      if (siteNavigation.classList.contains('toggled')) {
        menuToggle.setAttribute('aria-expanded', 'true');
      } else {
        menuToggle.setAttribute('aria-expanded', 'false');
      }
    });

    // Cerrar menú al hacer clic fuera
    document.addEventListener('click', function(event) {
      const isClickInside = siteNavigation.contains(event.target);
      const isClickOnToggle = menuToggle.contains(event.target);

      if (!isClickInside && !isClickOnToggle && siteNavigation.classList.contains('toggled')) {
        siteNavigation.classList.remove('toggled');
        menuToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /**
   * Menú lateral (sidebar) colapsable
   */
  if (sidebarToggle && sidebar) {
    // Restaurar estado del sidebar desde localStorage
    const sidebarState = localStorage.getItem('sidebarCollapsed');
    
    if (sidebarState === 'true') {
      sidebar.classList.add('sidebar-collapsed');
      if (mainContent) {
        mainContent.classList.add('sidebar-collapsed-content');
      }
    }

    sidebarToggle.addEventListener('click', function() {
      sidebar.classList.toggle('sidebar-collapsed');
      
      if (mainContent) {
        mainContent.classList.toggle('sidebar-collapsed-content');
      }
      
      // Guardar estado en localStorage
      localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('sidebar-collapsed'));
    });
  }

  /**
   * Submenús en el sidebar
   */
  const sidebarSubmenus = document.querySelectorAll('.sidebar-submenu-toggle');
  
  if (sidebarSubmenus.length > 0) {
    sidebarSubmenus.forEach(function(submenuToggle) {
      submenuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        const parentItem = this.closest('.sidebar-menu-item');
        const submenu = parentItem.querySelector('.sidebar-submenu');
        
        if (submenu) {
          submenu.classList.toggle('active');
          this.classList.toggle('active');
          
          if (submenu.classList.contains('active')) {
            this.setAttribute('aria-expanded', 'true');
          } else {
            this.setAttribute('aria-expanded', 'false');
          }
        }
      });
    });
  }

  /**
   * Accesibilidad para la navegación con teclado
   */
  function handleFocus() {
    const focusableElements = siteNavigation.querySelectorAll('a, button');
    
    focusableElements.forEach(function(element) {
      element.addEventListener('focus', function() {
        if (!siteNavigation.classList.contains('toggled') && window.innerWidth < 768) {
          siteNavigation.classList.add('toggled');
          menuToggle.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }

  if (siteNavigation) {
    handleFocus();
  }

  /**
   * Dropdown de usuario en el header
   */
  const userDropdownToggle = document.querySelector('.user-dropdown-toggle');
  const userDropdownMenu = document.querySelector('.user-dropdown-menu');
  
  if (userDropdownToggle && userDropdownMenu) {
    userDropdownToggle.addEventListener('click', function(e) {
      e.preventDefault();
      userDropdownMenu.classList.toggle('active');
      
      if (userDropdownMenu.classList.contains('active')) {
        userDropdownToggle.setAttribute('aria-expanded', 'true');
      } else {
        userDropdownToggle.setAttribute('aria-expanded', 'false');
      }
    });
    
    // Cerrar dropdown al hacer clic fuera
    document.addEventListener('click', function(event) {
      const isClickInside = userDropdownToggle.contains(event.target) || userDropdownMenu.contains(event.target);
      
      if (!isClickInside && userDropdownMenu.classList.contains('active')) {
        userDropdownMenu.classList.remove('active');
        userDropdownToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

})();
