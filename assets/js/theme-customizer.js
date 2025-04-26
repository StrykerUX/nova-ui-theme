/**
 * NovaUI - Customizer JS
 * JavaScript usado para las previsualizaciones del customizer
 */

(function($) {
    // Actualización de color primario en tiempo real
    wp.customize('nova_ui_primary_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-primary', newVal);
            
            // Calcular colores derivados
            const darkenAmount = -20;
            const darkenMoreAmount = -30;
            const primaryHover = adjustBrightness(newVal, darkenAmount);
            const primaryActive = adjustBrightness(newVal, darkenMoreAmount);
            
            document.documentElement.style.setProperty('--color-primary-hover', primaryHover);
            document.documentElement.style.setProperty('--color-primary-active', primaryActive);
        });
    });
    
    // Actualización de color secundario en tiempo real
    wp.customize('nova_ui_secondary_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-secondary', newVal);
        });
    });
    
    // Actualización de color de acento en tiempo real
    wp.customize('nova_ui_accent_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-accent', newVal);
        });
    });
    
    // Actualización de fuente principal en tiempo real
    wp.customize('nova_ui_primary_font', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--font-primary', newVal);
        });
    });
    
    // Actualización de tamaño de fuente base en tiempo real
    wp.customize('nova_ui_base_font_size', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--font-size-base', newVal);
            
            // Ajustar también el tamaño de fuente del body
            $('body').css('font-size', newVal);
        });
    });
    
    // Actualización de ancho del contenedor en tiempo real
    wp.customize('nova_ui_container_width', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--container-width', newVal);
        });
    });
    
    // Toggle de tema oscuro en tiempo real
    wp.customize('nova_ui_default_dark_mode', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                $('html').addClass('dark-mode').removeClass('light-mode');
            } else {
                $('html').removeClass('dark-mode').addClass('light-mode');
            }
        });
    });
    
    // Toggle de mostrar/ocultar en tiempo real
    wp.customize('nova_ui_show_dark_mode_toggle', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                $('#dark-mode-toggle').show();
            } else {
                $('#dark-mode-toggle').hide();
            }
        });
    });
    
    // Toggle de sombras neo-brutalistas en tiempo real
    wp.customize('nova_ui_enable_neobrutal_shadow', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                document.documentElement.style.setProperty('--shadow-md', '6px 6px 0 rgba(0, 0, 0, 0.1)');
                document.documentElement.style.setProperty('--shadow-lg', '10px 10px 0 rgba(0, 0, 0, 0.1)');
                
                // Ajustar para modo oscuro si está activo
                if ($('html').hasClass('dark-mode')) {
                    document.documentElement.style.setProperty('--shadow-md', '3px 3px 0 rgba(0, 0, 0, 0.3)');
                    document.documentElement.style.setProperty('--shadow-lg', '5px 5px 0 rgba(0, 0, 0, 0.3)');
                }
            } else {
                document.documentElement.style.setProperty('--shadow-md', '0 4px 6px rgba(0, 0, 0, 0.1)');
                document.documentElement.style.setProperty('--shadow-lg', '0 10px 15px rgba(0, 0, 0, 0.1)');
                
                // Ajustar para modo oscuro si está activo
                if ($('html').hasClass('dark-mode')) {
                    document.documentElement.style.setProperty('--shadow-md', '0 4px 6px rgba(0, 0, 0, 0.3)');
                    document.documentElement.style.setProperty('--shadow-lg', '0 10px 15px rgba(0, 0, 0, 0.3)');
                }
            }
        });
    });
    
    // Toggle de animaciones en tiempo real
    wp.customize('nova_ui_enable_animations', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                document.documentElement.style.setProperty('--transition-fast', '150ms');
                document.documentElement.style.setProperty('--transition-normal', '300ms');
                document.documentElement.style.setProperty('--transition-slow', '500ms');
            } else {
                document.documentElement.style.setProperty('--transition-fast', '0s');
                document.documentElement.style.setProperty('--transition-normal', '0s');
                document.documentElement.style.setProperty('--transition-slow', '0s');
            }
        });
    });
    
    // Toggle de colapso de sidebar por defecto (para dashboard)
    wp.customize('nova_ui_collapse_sidebar', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                $('.dashboard-sidebar').addClass('collapsed');
            } else {
                $('.dashboard-sidebar').removeClass('collapsed');
            }
        });
    });
    
    // Actualización de texto del footer en tiempo real
    wp.customize('nova_ui_footer_text', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                $('.site-info').html(newVal);
            } else {
                // Restablecer al contenido original
                $('.site-info').html(nova_ui_customizer_data.default_footer);
            }
        });
    });
    
    /**
     * Ajusta el brillo de un color hexadecimal
     *
     * @param {string} hex Color hexadecimal
     * @param {number} steps Pasos para ajustar (-255 a 255)
     * @return {string} Color hexadecimal ajustado
     */
    function adjustBrightness(hex, steps) {
        // Quitar # si existe
        hex = hex.replace(/^#/, '');
        
        // Convertir a RGB
        let r = parseInt(hex.substring(0, 2), 16);
        let g = parseInt(hex.substring(2, 4), 16);
        let b = parseInt(hex.substring(4, 6), 16);
        
        // Ajustar brillo
        r = Math.max(0, Math.min(255, r + steps));
        g = Math.max(0, Math.min(255, g + steps));
        b = Math.max(0, Math.min(255, b + steps));
        
        // Convertir de nuevo a hexadecimal
        const rHex = r.toString(16).padStart(2, '0');
        const gHex = g.toString(16).padStart(2, '0');
        const bHex = b.toString(16).padStart(2, '0');
        
        return `#${rHex}${gHex}${bHex}`;
    }
})(jQuery);
