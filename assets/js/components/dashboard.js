/**
 * Script para la funcionalidad del dashboard
 * 
 * Maneja la interactividad de los elementos en el dashboard con estilo Soft Neobrutalism
 * 
 * @package NovaUI
 */

(function() {
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar el menú de usuario
        initUserMenu();
        
        // Manejar collapse del sidebar
        initSidebar();
        
        // Manejar efectos Soft Neobrutalism
        initNeobrutalismEffects();
        
        // Manejar tarjetas colapsables
        initCollapsibleCards();
        
        // Manejar eventos de tareas
        initTaskEvents();
        
        // Inicializar tarjetas de stats
        initStatCards();
        
        // Manejar chat AI si está presente
        initChatAI();
    });
    
    /**
     * Inicializar menú de usuario
     */
    function initUserMenu() {
        const userBtn = document.querySelector('.user-btn');
        const userDropdown = document.querySelector('.user-dropdown');
        
        if (!userBtn || !userDropdown) {
            return;
        }
        
        userBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            userDropdown.classList.toggle('active');
        });
        
        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (userDropdown.classList.contains('active') && 
                !userDropdown.contains(e.target) && 
                !userBtn.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
        });
        
        // Cerrar menú con Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && userDropdown.classList.contains('active')) {
                userDropdown.classList.remove('active');
            }
        });
    }
    
    /**
     * Inicializar funcionalidad del sidebar
     */
    function initSidebar() {
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        const sidebar = document.querySelector('.dashboard-sidebar');
        const content = document.querySelector('.dashboard-content');
        const header = document.querySelector('.dashboard-header');
        
        if (!sidebarToggle || !sidebar) {
            return;
        }
        
        // Verificar si hay una preferencia guardada
        const isSidebarCollapsed = localStorage.getItem('novaui_sidebar_collapsed') === 'true';
        
        // Aplicar estado inicial
        if (isSidebarCollapsed) {
            sidebar.classList.add('collapsed');
            
            if (content) {
                content.classList.add('sidebar-collapsed');
            }
            
            if (header) {
                header.classList.add('sidebar-collapsed');
            }
        }
        
        // Toggle del sidebar
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('novaui_sidebar_collapsed', (!isCollapsed).toString());
            
            sidebar.classList.toggle('collapsed');
            
            if (content) {
                content.classList.toggle('sidebar-collapsed');
            }
            
            if (header) {
                header.classList.toggle('sidebar-collapsed');
            }
        });
        
        // Manejar responsivo del sidebar en dispositivos móviles
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        
        if (mobileToggle) {
            mobileToggle.addEventListener('click', function(e) {
                e.preventDefault();
                sidebar.classList.toggle('active');
                document.body.classList.toggle('sidebar-open');
            });
            
            // Cerrar sidebar al hacer clic fuera en móvil
            document.addEventListener('click', function(e) {
                const isMobile = window.innerWidth <= 768;
                
                if (isMobile && 
                    sidebar.classList.contains('active') && 
                    !sidebar.contains(e.target) && 
                    !mobileToggle.contains(e.target)) {
                    sidebar.classList.remove('active');
                    document.body.classList.remove('sidebar-open');
                }
            });
        }
        
        // Manejar estado activo de links del sidebar
        const navLinks = document.querySelectorAll('.dashboard-nav-link');
        
        navLinks.forEach(function(link) {
            // Comprobar URL actual
            if (link.href === window.location.href ||
                window.location.href.indexOf(link.href) === 0) {
                link.classList.add('active');
            }
            
            // Evento de clic
            link.addEventListener('click', function() {
                navLinks.forEach(function(l) {
                    l.classList.remove('active');
                });
                
                link.classList.add('active');
            });
        });
    }
    
    /**
     * Inicializar efectos visuales Soft Neobrutalism
     */
    function initNeobrutalismEffects() {
        // Efecto hover en tarjetas
        const cards = document.querySelectorAll('.stats-card, .widget, .quick-link-item');
        
        cards.forEach(function(card) {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = 'var(--shadow-large)';
                this.style.transition = 'transform 0.2s ease, box-shadow 0.2s ease';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });
        
        // Efecto click en botones
        const buttons = document.querySelectorAll('.page-action-btn, .chat-send, .quick-link-edit, .membership-upgrade');
        
        buttons.forEach(function(button) {
            button.addEventListener('mousedown', function() {
                this.style.transform = 'translateY(2px)';
                this.style.boxShadow = 'var(--shadow-small)';
            });
            
            button.addEventListener('mouseup', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = 'var(--shadow-large)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });
    }
    
    /**
     * Inicializar tarjetas colapsables
     */
    function initCollapsibleCards() {
        const collapsibleCards = document.querySelectorAll('.nova-card-collapsible');
        
        collapsibleCards.forEach(function(card) {
            const header = card.querySelector('.nova-card-header');
            
            if (header) {
                header.addEventListener('click', function() {
                    card.classList.toggle('collapsed');
                });
            }
        });
    }
    
    /**
     * Inicializar eventos para tareas
     */
    function initTaskEvents() {
        const taskCheckboxes = document.querySelectorAll('.task-checkbox');
        
        taskCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const taskItem = this.closest('.quick-link-item');
                
                if (this.checked) {
                    taskItem.style.opacity = '0.6';
                    taskItem.style.textDecoration = 'line-through';
                } else {
                    taskItem.style.opacity = '';
                    taskItem.style.textDecoration = '';
                }
            });
        });
    }
    
    /**
     * Inicializar tarjetas de estadísticas con animación
     */
    function initStatCards() {
        const statValues = document.querySelectorAll('.stats-card-value');
        
        statValues.forEach(function(value) {
            // Animación al cargar la página
            const originalText = value.textContent;
            const isNumber = !isNaN(parseFloat(originalText.replace(/[^0-9.-]+/g, '')));
            
            if (isNumber) {
                const numericValue = parseFloat(originalText.replace(/[^0-9.-]+/g, ''));
                const prefix = originalText.split(numericValue)[0];
                const suffix = originalText.split(numericValue)[1] || '';
                
                // Animar desde 0 hasta el valor final
                value.textContent = prefix + '0' + suffix;
                
                let start = 0;
                const end = numericValue;
                const duration = 1000; // 1 segundo
                const frameDuration = 1000 / 60; // 60fps
                const totalFrames = Math.round(duration / frameDuration);
                
                let frame = 0;
                
                function updateNumber() {
                    frame++;
                    const progress = frame / totalFrames;
                    const currentValue = isNaN(end) ? 0 : Math.round(end * progress * 100) / 100;
                    
                    value.textContent = prefix + currentValue + suffix;
                    
                    if (frame < totalFrames) {
                        requestAnimationFrame(updateNumber);
                    } else {
                        value.textContent = originalText;
                    }
                }
                
                requestAnimationFrame(updateNumber);
            }
        });
    }
    
    /**
     * Inicializar la funcionalidad del chat AI
     */
    function initChatAI() {
        const chatInput = document.querySelector('.chat-input');
        const chatSend = document.querySelector('.chat-send');
        const chatContainer = document.querySelector('.chat-container');
        
        if (!chatInput || !chatSend || !chatContainer) {
            return;
        }
        
        // Función para agregar mensaje del usuario
        function addUserMessage(message) {
            const userMessage = document.createElement('div');
            userMessage.className = 'chat-message user-message';
            userMessage.innerHTML = `
                <div class="chat-bubble user">
                    <p>${message}</p>
                </div>
                <div class="chat-avatar user">M</div>
            `;
            chatContainer.appendChild(userMessage);
            
            // Scroll al final del chat
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
        
        // Función para simular respuesta del AI
        function simulateAIResponse() {
            // Mostrar un indicador de escritura
            const typingIndicator = document.createElement('div');
            typingIndicator.className = 'chat-message';
            typingIndicator.innerHTML = `
                <div class="chat-avatar ai">AI</div>
                <div class="chat-bubble ai">
                    <p>...</p>
                </div>
            `;
            chatContainer.appendChild(typingIndicator);
            chatContainer.scrollTop = chatContainer.scrollHeight;
            
            // Simular tiempo de respuesta
            setTimeout(function() {
                // Eliminar indicador de escritura
                chatContainer.removeChild(typingIndicator);
                
                // Añadir respuesta AI
                const aiMessage = document.createElement('div');
                aiMessage.className = 'chat-message';
                aiMessage.innerHTML = `
                    <div class="chat-avatar ai">AI</div>
                    <div class="chat-bubble ai">
                        <p>Here's the breakdown of sales by category. The top performer is "Software Services" with a 28% increase compared to last month.</p>
                    </div>
                `;
                chatContainer.appendChild(aiMessage);
                
                // Scroll al final del chat
                chatContainer.scrollTop = chatContainer.scrollHeight;
                
                // Actualizar contador de tokens
                const tokensCount = document.querySelector('.chat-tokens-count');
                if (tokensCount) {
                    const currentTokens = parseInt(tokensCount.textContent, 10);
                    tokensCount.textContent = Math.max(0, currentTokens - 25).toString();
                }
            }, 1500);
        }
        
        // Evento de clic en botón de enviar
        chatSend.addEventListener('click', function() {
            const message = chatInput.value.trim();
            
            if (message) {
                addUserMessage(message);
                chatInput.value = '';
                
                // Simular respuesta del AI
                simulateAIResponse();
            }
        });
        
        // Enviar con Enter
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && chatInput.value.trim()) {
                chatSend.click();
            }
        });
    }
})();
