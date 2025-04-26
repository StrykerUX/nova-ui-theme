/**
 * NovaUI - Dashboard JavaScript
 * Controlador para funciones interactivas del dashboard
 */

document.addEventListener('DOMContentLoaded', function() {
    // Toggle de sidebar colapsable
    const sidebarToggleBtn = document.querySelector('.sidebar-toggle');
    const dashboardSidebar = document.querySelector('.dashboard-sidebar');
    
    if (sidebarToggleBtn && dashboardSidebar) {
        sidebarToggleBtn.addEventListener('click', function() {
            dashboardSidebar.classList.toggle('collapsed');
            
            // Actualizar aria-expanded
            const isExpanded = !dashboardSidebar.classList.contains('collapsed');
            sidebarToggleBtn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            
            // Guardar preferencia en localStorage
            localStorage.setItem('nova_ui_sidebar_collapsed', dashboardSidebar.classList.contains('collapsed'));
        });
        
        // Comprobar si hay una preferencia guardada
        const sidebarCollapsed = localStorage.getItem('nova_ui_sidebar_collapsed') === 'true';
        if (sidebarCollapsed) {
            dashboardSidebar.classList.add('collapsed');
            sidebarToggleBtn.setAttribute('aria-expanded', 'false');
        }
    }
    
    // Toggle del menú de usuario
    const userToggleBtn = document.querySelector('.dashboard-user-toggle');
    const userDropdown = document.querySelector('.dashboard-user-dropdown');
    
    if (userToggleBtn && userDropdown) {
        userToggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            userDropdown.classList.toggle('active');
            
            // Actualizar aria-expanded
            const isExpanded = userDropdown.classList.contains('active');
            userToggleBtn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        });
        
        // Cerrar el menú si se hace clic fuera de él
        document.addEventListener('click', function(e) {
            if (!userToggleBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('active');
                userToggleBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }
    
    // Toggle del menú móvil
    const mobileToggleBtn = document.querySelector('.dashboard-mobile-menu-toggle');
    
    if (mobileToggleBtn && dashboardSidebar) {
        mobileToggleBtn.addEventListener('click', function() {
            dashboardSidebar.classList.toggle('active');
        });
    }
    
    // Dark mode toggle
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            
            // Actualizar interfaz para modo oscuro
            updateDarkModeUI();
            
            // Guardar preferencia
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('nova_ui_dark_mode', isDarkMode ? 'dark' : 'light');
            
            // Si WordPress está activado, también enviar AJAX
            if (typeof novaUISettings !== 'undefined') {
                fetch(novaUISettings.ajaxurl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=nova_ui_set_dark_mode&mode=' + (isDarkMode ? 'dark' : 'light')
                });
            }
        });
        
        // Comprobar preferencia guardada o preferencia del sistema
        initializeThemeMode();
    }
    
    // Inicializar tema basado en preferencias
    function initializeThemeMode() {
        const savedTheme = localStorage.getItem('nova_ui_dark_mode');
        
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
        } else if (savedTheme === 'light') {
            document.body.classList.remove('dark-mode');
        } else {
            // Si no hay preferencia guardada, comprobar preferencia del sistema
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.body.classList.add('dark-mode');
            }
        }
        
        // Actualizar interfaz
        updateDarkModeUI();
        
        // Añadir listener para cambios en la preferencia del sistema
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                if (localStorage.getItem('nova_ui_dark_mode') === null) {
                    if (e.matches) {
                        document.body.classList.add('dark-mode');
                    } else {
                        document.body.classList.remove('dark-mode');
                    }
                    updateDarkModeUI();
                }
            });
        }
    }
    
    // Actualizar UI para modo oscuro
    function updateDarkModeUI() {
        const isDarkMode = document.body.classList.contains('dark-mode');
        
        // Actualizar iconos de toggle si existen
        const moonIcon = document.querySelector('.icon-moon');
        const sunIcon = document.querySelector('.icon-sun');
        
        if (moonIcon && sunIcon) {
            if (isDarkMode) {
                moonIcon.style.display = 'none';
                sunIcon.style.display = 'block';
            } else {
                moonIcon.style.display = 'block';
                sunIcon.style.display = 'none';
            }
        }
    }
    
    // Menu activo basado en la página actual
    const currentLocation = window.location.pathname;
    const menuItems = document.querySelectorAll('.dashboard-menu-item');
    
    menuItems.forEach(function(item) {
        const itemLink = item.querySelector('a').getAttribute('href');
        
        if (itemLink === currentLocation || currentLocation.startsWith(itemLink)) {
            item.classList.add('active');
        }
    });
    
    // Inicializar contadores de stats si existen
    initStatsCounters();
    
    function initStatsCounters() {
        const statsValues = document.querySelectorAll('.stats-card-value');
        
        statsValues.forEach(function(statValue) {
            const finalValue = statValue.textContent;
            
            // Solo animar valores numéricos
            if (!isNaN(parseFloat(finalValue.replace(/[^0-9.-]+/g, '')))) {
                animateCounter(statValue, finalValue);
            }
        });
    }
    
    function animateCounter(element, finalValue) {
        // Guardar el valor original para referencia
        const originalText = finalValue;
        
        // Extraer solo los números para la animación
        const numericValue = parseFloat(finalValue.replace(/[^0-9.-]+/g, ''));
        const prefix = finalValue.substring(0, finalValue.indexOf(numericValue));
        const suffix = finalValue.substring(finalValue.indexOf(numericValue) + numericValue.toString().length);
        
        // Empezar en 0
        let startValue = 0;
        const duration = 1000; // 1 segundo de animación
        const startTime = performance.now();
        
        // Función de animación
        function updateCounter(currentTime) {
            const elapsedTime = currentTime - startTime;
            
            if (elapsedTime < duration) {
                const progress = elapsedTime / duration;
                const currentValue = Math.floor(numericValue * progress);
                
                // Actualizar texto con formato original
                element.textContent = prefix + currentValue.toLocaleString() + suffix;
                
                // Continuar animación
                requestAnimationFrame(updateCounter);
            } else {
                // Asegurarse de que el valor final sea exacto
                element.textContent = originalText;
            }
        }
        
        // Iniciar animación
        requestAnimationFrame(updateCounter);
    }
});
