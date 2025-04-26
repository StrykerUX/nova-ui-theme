/**
 * Nova UI - Scripts principales
 */

(function($) {
    'use strict';

    // Variables globales
    let sidebarCollapsed = false;
    let darkMode = false;

    /**
     * Inicialización al cargar el documento
     */
    $(document).ready(function() {
        // Detectar estado de la barra lateral
        initSidebar();
        
        // Inicializar tema claro/oscuro
        initTheme();
        
        // Eventos de UI
        bindEvents();
        
        // Marcar elementos de menú activos
        highlightActiveMenuItem();
        
        // Detectar elementos del UI
        setupUIComponents();
    });

    /**
     * Inicializar la barra lateral
     */
    function initSidebar() {
        // Verificar cookie para estado de la barra lateral
        sidebarCollapsed = localStorage.getItem('nova_ui_sidebar_collapsed') === 'true';
        
        if (sidebarCollapsed) {
            $('#sidebar').addClass('sidebar-collapsed');
        } else {
            $('#sidebar').removeClass('sidebar-collapsed');
        }
        
        // Para vista móvil
        if (window.innerWidth < 992) {
            $('#sidebar').removeClass('sidebar-mobile-visible');
        }
    }

    /**
     * Inicializar tema claro/oscuro
     */
    function initTheme() {
        // Verificar cookie para el tema
        darkMode = localStorage.getItem('nova_ui_dark_mode') === 'true';
        
        if (darkMode) {
            $('html').attr('data-theme', 'dark');
            $('#theme-toggle i').removeClass('ti-moon').addClass('ti-sun');
        } else {
            $('html').attr('data-theme', 'light');
            $('#theme-toggle i').removeClass('ti-sun').addClass('ti-moon');
        }
    }

    /**
     * Asociar eventos de UI
     */
    function bindEvents() {
        // Toggle de la barra lateral (botón en la barra superior para móvil)
        $('#sidebar-toggle').on('click', function(e) {
            e.preventDefault();
            $('#sidebar').toggleClass('sidebar-mobile-visible');
        });
        
        // Toggle de la barra lateral (botón en el sidebar)
        $('#sidebar-collapse-btn').on('click', function(e) {
            e.preventDefault();
            toggleSidebar();
        });
        
        // Botón para cambiar tema claro/oscuro
        $('#theme-toggle').on('click', function(e) {
            e.preventDefault();
            toggleTheme();
        });
        
        // Cerrar sidebar en móvil al hacer clic fuera
        $(document).on('click', function(e) {
            if (
                window.innerWidth < 992 &&
                !$(e.target).closest('#sidebar').length && 
                !$(e.target).closest('#sidebar-toggle').length && 
                $('#sidebar').hasClass('sidebar-mobile-visible')
            ) {
                $('#sidebar').removeClass('sidebar-mobile-visible');
            }
        });
        
        // Responsive: reiniciar layout al cambiar tamaño de ventana
        $(window).on('resize', function() {
            if (window.innerWidth >= 992) {
                $('#sidebar').removeClass('sidebar-mobile-visible');
            }
        });
        
        // Atajo de teclado para buscar
        $(document).on('keydown', function(e) {
            // Comando/Control + K para buscar
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                $('.search-input').focus();
            }
        });
    }

    /**
     * Toggle para la barra lateral
     */
    function toggleSidebar() {
        sidebarCollapsed = !sidebarCollapsed;
        
        if (sidebarCollapsed) {
            $('#sidebar').addClass('sidebar-collapsed');
        } else {
            $('#sidebar').removeClass('sidebar-collapsed');
        }
        
        // Guardar preferencia
        localStorage.setItem('nova_ui_sidebar_collapsed', sidebarCollapsed);
    }

    /**
     * Toggle para tema claro/oscuro
     */
    function toggleTheme() {
        darkMode = !darkMode;
        
        if (darkMode) {
            $('html').attr('data-theme', 'dark');
            $('#theme-toggle i').removeClass('ti-moon').addClass('ti-sun');
        } else {
            $('html').attr('data-theme', 'light');
            $('#theme-toggle i').removeClass('ti-sun').addClass('ti-moon');
        }
        
        // Guardar preferencia
        localStorage.setItem('nova_ui_dark_mode', darkMode);
    }

    /**
     * Marcar elemento de menú activo
     */
    function highlightActiveMenuItem() {
        // Obtener la ruta actual
        const currentPath = window.location.pathname;
        
        // Recorrer los elementos del menú
        $('.menu-link').each(function() {
            const linkPath = $(this).attr('href');
            
            if (linkPath && currentPath.includes(linkPath) && linkPath !== '/') {
                $(this).closest('.menu-item').addClass('active');
            } else if (currentPath === '/' && linkPath === '/') {
                $(this).closest('.menu-item').addClass('active');
            }
        });
    }

    /**
     * Configurar componentes de UI adicionales
     */
    function setupUIComponents() {
        // Chat AI - Enviar mensaje al hacer click o presionar Enter
        $('.chat-send-btn').on('click', function() {
            sendChatMessage();
        });
        
        $('.chat-input').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                sendChatMessage();
            }
        });
        
        // Botones de edición en enlaces rápidos
        $('.quick-link-item .btn').on('click', function(e) {
            e.preventDefault();
            
            // En una implementación real, aquí iría la lógica para editar
            alert('Función de edición no implementada en esta versión');
        });
        
        // Widget de ayuda flotante
        $('.help-widget-floating').on('click', function() {
            // En una implementación real, aquí iría la lógica para mostrar ayuda
            alert('Documentación no disponible en esta versión');
        });
    }

    /**
     * Simular envío de mensaje en chat
     */
    function sendChatMessage() {
        const $input = $('.chat-input');
        const message = $input.val().trim();
        
        if (message !== '') {
            // En una implementación real, aquí iría la lógica para procesar el mensaje
            // Esta es solo una demostración visual
            
            const userName = 'Usuario';
            const userInitial = 'M'; // Podría obtenerse del perfil del usuario
            
            // Crear elemento de mensaje del usuario
            const $userMessage = $(`
                <div class="chat-message user-message">
                    <div class="message-content">
                        <p>${message}</p>
                    </div>
                    <div class="message-avatar">
                        <div class="avatar-icon" style="background-color: #FF6B6B;">
                            <span>${userInitial}</span>
                        </div>
                    </div>
                </div>
            `);
            
            // Añadir mensaje a la conversación
            $('.chat-messages').append($userMessage);
            
            // Limpiar input
            $input.val('');
            
            // Simular respuesta del AI después de 1 segundo
            setTimeout(function() {
                const aiResponse = 'Lo siento, este es un tema de demostración. La funcionalidad de AI no está implementada.';
                
                const $aiMessage = $(`
                    <div class="chat-message ai-message">
                        <div class="message-avatar">
                            <div class="avatar-icon" style="background-color: #4ECDC4;">
                                <span>AI</span>
                            </div>
                        </div>
                        <div class="message-content">
                            <p>${aiResponse}</p>
                        </div>
                    </div>
                `);
                
                $('.chat-messages').append($aiMessage);
                
                // Scroll al final de la conversación
                $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
            }, 1000);
        }
    }

})(jQuery);
