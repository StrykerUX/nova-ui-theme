/**
 * Scripts específicos para la plantilla de dashboard
 * NovaUI Theme - Soft Neubrutalism
 */

(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', function() {
    // Referencias a elementos del DOM
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const dashboardContent = document.querySelector('.dashboard-content');
    const submenuToggles = document.querySelectorAll('.sidebar-submenu-toggle');
    const userDropdownToggle = document.querySelector('.user-dropdown-toggle');
    const userDropdownMenu = document.querySelector('.user-dropdown-menu');
    const periodSelectors = document.querySelectorAll('.tasks-period-selector');
    
    // Toggle del sidebar
    if (sidebarToggle && sidebar && dashboardContent) {
      // Restaurar estado del sidebar desde localStorage
      const sidebarState = localStorage.getItem('sidebarCollapsed');
      
      if (sidebarState === 'true') {
        sidebar.classList.add('sidebar-collapsed');
        dashboardContent.classList.add('sidebar-collapsed-content');
      }
      
      sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('sidebar-collapsed');
        dashboardContent.classList.toggle('sidebar-collapsed-content');
        
        // Guardar estado en localStorage
        localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('sidebar-collapsed'));
      });
    }
    
    // Submenús en el sidebar
    if (submenuToggles.length > 0) {
      submenuToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
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
    
    // User dropdown en el header
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
    
    // Selector de período para tareas
    if (periodSelectors.length > 0) {
      periodSelectors.forEach(function(selector) {
        selector.addEventListener('change', function() {
          // En una implementación real, esto cargaría tareas según el período seleccionado
          // mediante AJAX. Por ahora, solo simularemos el comportamiento.
          const taskSection = this.closest('.tasks-section');
          const loadingIndicator = document.createElement('div');
          loadingIndicator.className = 'tasks-loading';
          loadingIndicator.textContent = 'Loading...';
          
          const tasksContent = taskSection.querySelector('.tasks-content');
          tasksContent.innerHTML = '';
          tasksContent.appendChild(loadingIndicator);
          
          // Simular carga de datos
          setTimeout(function() {
            tasksContent.innerHTML = '<div class="tasks-list"><div class="task-item"><div class="task-left"><div class="task-checkbox"></div><div class="task-info"><div class="task-title">Task filtered by period</div><div class="task-time">3:00 PM</div></div></div><div class="task-priority task-priority-medium">Medium</div></div></div>';
          }, 1000);
        });
      });
    }
    
    // Chat IA widget
    const chatForm = document.querySelector('.chat-ia-input-container');
    if (chatForm) {
      chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const inputField = this.querySelector('.chat-ia-input');
        const message = inputField.value.trim();
        
        if (message) {
          // Añadir mensaje del usuario
          const conversation = document.querySelector('.chat-ia-widget-conversation');
          const currentUser = document.querySelector('.chat-ia-avatar-user');
          const userInitial = currentUser ? currentUser.textContent : 'U';
          
          const userMessage = document.createElement('div');
          userMessage.className = 'chat-ia-message chat-ia-message-user';
          userMessage.innerHTML = `
            <div class="chat-ia-bubble chat-ia-bubble-user">
              ${message}
            </div>
            <div class="chat-ia-avatar chat-ia-avatar-user">
              ${userInitial}
            </div>
          `;
          
          conversation.appendChild(userMessage);
          
          // Limpiar campo de entrada
          inputField.value = '';
          
          // Simular respuesta de la IA
          // En una implementación real, esto enviaría el mensaje a la API del plugin
          setTimeout(function() {
            const aiResponse = document.createElement('div');
            aiResponse.className = 'chat-ia-message chat-ia-message-ai';
            aiResponse.innerHTML = `
              <div class="chat-ia-avatar chat-ia-avatar-ai">AI</div>
              <div class="chat-ia-bubble chat-ia-bubble-ai">
                This is a simulated response. In a real implementation, this would be processed by the Chat IA plugin.
              </div>
            `;
            
            conversation.appendChild(aiResponse);
            conversation.scrollTop = conversation.scrollHeight;
          }, 1000);
        }
      });
    }
    
    // Quick Links
    const quickLinkItems = document.querySelectorAll('.quick-link-item');
    if (quickLinkItems.length > 0) {
      quickLinkItems.forEach(function(item) {
        item.addEventListener('mouseenter', function() {
          this.classList.add('quick-link-item-hover');
        });
        
        item.addEventListener('mouseleave', function() {
          this.classList.remove('quick-link-item-hover');
        });
      });
    }
  });
  
})();
