/**
 * Script principal del tema NovaUI
 * 
 * @package NovaUI
 */

(function() {
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar componentes interactivos
        initNovaUIComponents();
        
        // Inicializar los tooltips
        initTooltips();
        
        // Activar animaciones de scroll
        initScrollAnimations();
        
        // Manejar menú móvil en header estándar
        initMobileMenu();
        
        // Manejar menú de usuario en dashboard
        initUserMenu();
    });
    
    /**
     * Inicializar componentes de UI con estilo Neo-brutalista
     */
    function initNovaUIComponents() {
        // Inicializar tarjetas con efecto hover
        const novaCards = document.querySelectorAll('.nova-card');
        
        novaCards.forEach(function(card) {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = 'var(--shadow-large)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });
        
        // Inicializar botones con efecto click
        const novaButtons = document.querySelectorAll('.nova-button');
        
        novaButtons.forEach(function(button) {
            button.addEventListener('mousedown', function() {
                this.style.transform = 'translateY(2px)';
                this.style.boxShadow = 'var(--shadow-active)';
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
        
        // Inicializar badges con animación
        const novaBadges = document.querySelectorAll('.nova-badge.animated');
        
        novaBadges.forEach(function(badge) {
            badge.classList.add('animate-pulse');
        });
    }
    
    /**
     * Inicializar tooltips
     */
    function initTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');
        
        tooltipElements.forEach(function(element) {
            element.addEventListener('mouseenter', function() {
                const tooltipText = this.getAttribute('data-tooltip');
                const position = this.getAttribute('data-tooltip-position') || 'top';
                
                // Crear elemento tooltip
                const tooltip = document.createElement('div');
                tooltip.className = `nova-tooltip nova-tooltip-${position}`;
                tooltip.textContent = tooltipText;
                
                // Añadir tooltip al elemento
                this.appendChild(tooltip);
                
                // Posicionar tooltip
                const rect = this.getBoundingClientRect();
                const tooltipRect = tooltip.getBoundingClientRect();
                
                if (position === 'top') {
                    tooltip.style.bottom = `${rect.height + 5}px`;
                    tooltip.style.left = `${(rect.width - tooltipRect.width) / 2}px`;
                } else if (position === 'bottom') {
                    tooltip.style.top = `${rect.height + 5}px`;
                    tooltip.style.left = `${(rect.width - tooltipRect.width) / 2}px`;
                } else if (position === 'left') {
                    tooltip.style.right = `${rect.width + 5}px`;
                    tooltip.style.top = `${(rect.height - tooltipRect.height) / 2}px`;
                } else if (position === 'right') {
                    tooltip.style.left = `${rect.width + 5}px`;
                    tooltip.style.top = `${(rect.height - tooltipRect.height) / 2}px`;
                }
                
                // Mostrar tooltip con animación
                setTimeout(function() {
                    tooltip.classList.add('active');
                }, 10);
            });
            
            element.addEventListener('mouseleave', function() {
                const tooltip = this.querySelector('.nova-tooltip');
                
                if (tooltip) {
                    tooltip.classList.remove('active');
                    
                    // Remover elemento después de la animación
                    setTimeout(function() {
                        if (tooltip.parentNode) {
                            tooltip.parentNode.removeChild(tooltip);
                        }
                    }, 200);
                }
            });
        });
    }
    
    /**
     * Inicializar animaciones al hacer scroll
     */
    function initScrollAnimations() {
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        
        // Función para verificar si un elemento está visible
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            
            return (
                rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.8 &&
                rect.bottom >= 0
            );
        }
        
        // Comprobar elementos visibles al cargar la página
        animatedElements.forEach(function(element) {
            if (isElementInViewport(element)) {
                element.classList.add('animated');
            }
        });
        
        // Comprobar elementos visibles al hacer scroll
        window.addEventListener('scroll', function() {
            animatedElements.forEach(function(element) {
                if (isElementInViewport(element) && !element.classList.contains('animated')) {
                    element.classList.add('animated');
                }
            });
        });
    }
    
    /**
     * Inicializar menú móvil en header estándar
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const primaryMenuContainer = document.querySelector('.primary-menu-container');
        
        if (!menuToggle || !primaryMenuContainer) {
            return;
        }
        
        menuToggle.addEventListener('click', function() {
            primaryMenuContainer.classList.toggle('active');
            menuToggle.setAttribute(
                'aria-expanded', 
                menuToggle.getAttribute('aria-expanded') === 'true' ? 'false' : 'true'
            );
        });
        
        // Cerrar menú al hacer click fuera
        document.addEventListener('click', function(event) {
            if (primaryMenuContainer.classList.contains('active') && 
                !primaryMenuContainer.contains(event.target) && 
                !menuToggle.contains(event.target)) {
                primaryMenuContainer.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
    
    /**
     * Inicializar menú de usuario en dashboard
     */
    function initUserMenu() {
        const userBtn = document.querySelector('.user-btn');
        const userDropdown = document.querySelector('.user-dropdown');
        
        if (!userBtn || !userDropdown) {
            return;
        }
        
        userBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            userDropdown.classList.toggle('active');
        });
        
        // Cerrar menú al hacer click fuera
        document.addEventListener('click', function(event) {
            if (userDropdown.classList.contains('active') && 
                !userDropdown.contains(event.target) && 
                !userBtn.contains(event.target)) {
                userDropdown.classList.remove('active');
            }
        });
        
        // También cerrar al presionar Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && userDropdown.classList.contains('active')) {
                userDropdown.classList.remove('active');
            }
        });
    }
})();
