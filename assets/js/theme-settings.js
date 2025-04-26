/**
 * NovaUI Theme - Configuración del tema
 * 
 * Este script gestiona las interacciones con el personalizador de WordPress
 * y aplica los cambios de configuración en tiempo real.
 */

(function($) {
    // Disponible solo cuando el customizer de WordPress está activo
    if (!wp || !wp.customize) {
        return;
    }
    
    // Cachear los elementos DOM frecuentemente usados
    const $body = $('body');
    const $html = $('html');
    
    // Colores primarios
    wp.customize('novaui_primary_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-primary', newVal);
            // Actualizar colores hover/active basados en el primario
            const primaryHover = adjustColor(newVal, -10);
            const primaryActive = adjustColor(newVal, -20);
            document.documentElement.style.setProperty('--color-primary-hover', primaryHover);
            document.documentElement.style.setProperty('--color-primary-active', primaryActive);
        });
    });
    
    wp.customize('novaui_secondary_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-secondary', newVal);
            const secondaryHover = adjustColor(newVal, -10);
            const secondaryActive = adjustColor(newVal, -20);
            document.documentElement.style.setProperty('--color-secondary-hover', secondaryHover);
            document.documentElement.style.setProperty('--color-secondary-active', secondaryActive);
        });
    });
    
    wp.customize('novaui_accent_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-accent', newVal);
        });
    });
    
    // Colores de estado
    wp.customize('novaui_success_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-success', newVal);
        });
    });
    
    wp.customize('novaui_warning_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-warning', newVal);
        });
    });
    
    wp.customize('novaui_error_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-error', newVal);
        });
    });
    
    // Colores de texto y fondo
    wp.customize('novaui_text_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-text', newVal);
        });
    });
    
    wp.customize('novaui_background_color', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--color-background', newVal);
        });
    });
    
    // Tipografía
    wp.customize('novaui_font_primary', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--font-primary', newVal);
        });
    });
    
    wp.customize('novaui_font_secondary', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--font-secondary', newVal);
        });
    });
    
    wp.customize('novaui_font_size_base', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--font-size-base', newVal + 'px');
        });
    });
    
    // Bordes y esquinas
    wp.customize('novaui_border_radius', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--border-radius-md', newVal + 'px');
            document.documentElement.style.setProperty('--border-radius-sm', (parseInt(newVal) / 2) + 'px');
            document.documentElement.style.setProperty('--border-radius-lg', (parseInt(newVal) * 1.5) + 'px');
        });
    });
    
    wp.customize('novaui_border_width', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--border-width', newVal + 'px');
        });
    });
    
    // Sombras - Ajuste del estilo Soft Neubrutalism
    wp.customize('novaui_shadow_intensity', function(value) {
        value.bind(function(newVal) {
            const intensity = parseInt(newVal) / 100;
            document.documentElement.style.setProperty('--shadow-sm', `${Math.round(3 * intensity)}px ${Math.round(3 * intensity)}px 0 rgba(0, 0, 0, ${0.05 * intensity})`);
            document.documentElement.style.setProperty('--shadow-md', `${Math.round(6 * intensity)}px ${Math.round(6 * intensity)}px 0 rgba(0, 0, 0, ${0.1 * intensity})`);
            document.documentElement.style.setProperty('--shadow-lg', `${Math.round(8 * intensity)}px ${Math.round(8 * intensity)}px 0 rgba(0, 0, 0, ${0.15 * intensity})`);
        });
    });
    
    // Container width
    wp.customize('novaui_container_width', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--container-width', newVal + 'px');
        });
    });
    
    // Sidebar width
    wp.customize('novaui_sidebar_width', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--sidebar-width', newVal + 'px');
        });
    });
    
    // Visibilidad del tema claro/oscuro
    wp.customize('novaui_dark_mode_toggle', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--theme-toggle-visibility', newVal ? 'visible' : 'hidden');
            $('.theme-toggle').toggle(newVal);
        });
    });
    
    // Aplicar presets de colores
    wp.customize('novaui_color_preset', function(value) {
        value.bind(function(newVal) {
            // Los presets se aplican a través de PHP, pero podemos mostrar una notificación
            if (newVal !== 'custom') {
                showNotification('Preset de colores aplicado. Guarda los cambios para mantenerlos.');
            }
        });
    });
    
    // Utilidades
    
    // Ajustar un color (aclarar u oscurecer)
    function adjustColor(color, percent) {
        if (!color) return color;
        
        // Convertir a rgb si es hex
        let r, g, b;
        if (color.startsWith('#')) {
            const hex = color.substring(1);
            r = parseInt(hex.substr(0, 2), 16);
            g = parseInt(hex.substr(2, 2), 16);
            b = parseInt(hex.substr(4, 2), 16);
        } else if (color.startsWith('rgb')) {
            const rgb = color.match(/\d+/g);
            r = parseInt(rgb[0]);
            g = parseInt(rgb[1]);
            b = parseInt(rgb[2]);
        } else {
            return color;
        }
        
        // Ajustar el color
        r = Math.max(0, Math.min(255, r + percent));
        g = Math.max(0, Math.min(255, g + percent));
        b = Math.max(0, Math.min(255, b + percent));
        
        // Convertir de vuelta a hex
        return `#${((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1)}`;
    }
    
    // Mostrar una notificación
    function showNotification(message) {
        const notification = $('<div class="novaui-notification"></div>').text(message);
        $('body').append(notification);
        
        setTimeout(function() {
            notification.addClass('show');
            
            setTimeout(function() {
                notification.removeClass('show');
                setTimeout(function() {
                    notification.remove();
                }, 300);
            }, 3000);
        }, 10);
    }
})(jQuery);
