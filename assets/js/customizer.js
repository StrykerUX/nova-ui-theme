/**
 * File customizer.js.
 *
 * Adds live changes for customizer controls
 */
(function($) {
    // Update site colors in real time
    wp.customize('novaui_primary_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-primary', newval);
            
            // Actualizar elementos que usan este color
            $('.text-primary, a, .dashboard-brand-accent, .widget-title-icon, .nova-brand-accent, .dashboard-nav-link.active .dashboard-nav-icon').css('color', newval);
            $('.bg-primary, .button, .page-action-btn-primary, .dashboard-logo, .user-avatar, .chat-send').css('background-color', newval);
            $('.button, .page-action-btn-primary').css('border-color', newval);
        });
    });
    
    wp.customize('novaui_secondary_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-secondary', newval);
            
            // Actualizar elementos que usan este color
            $('.text-secondary').css('color', newval);
            $('.bg-secondary, .button-secondary').css('background-color', newval);
            $('.button-secondary').css('border-color', newval);
        });
    });
    
    wp.customize('novaui_accent_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-accent', newval);
            
            // Actualizar elementos que usan este color
            $('.text-accent').css('color', newval);
            $('.bg-accent, .button-accent').css('background-color', newval);
            $('.button-accent').css('border-color', newval);
            
            // Para el tema oscuro, actualizar el color del icono del sol
            if ($('body').hasClass('dark-mode')) {
                $('.theme-toggle-light').css('color', newval);
            }
        });
    });
    
    // Update default theme mode
    wp.customize('novaui_default_theme_mode', function(value) {
        value.bind(function(newval) {
            // Esta preferencia requiere recargar la página para aplicarse completamente
            if (newval === 'dark') {
                $('body').addClass('dark-mode');
                document.documentElement.classList.add('dark-mode');
            } else if (newval === 'light') {
                $('body').removeClass('dark-mode');
                document.documentElement.classList.remove('dark-mode');
            } else {
                // Modo automático - comprobar preferencia del sistema
                const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                
                if (prefersDark) {
                    $('body').addClass('dark-mode');
                    document.documentElement.classList.add('dark-mode');
                } else {
                    $('body').removeClass('dark-mode');
                    document.documentElement.classList.remove('dark-mode');
                }
            }
        });
    });
    
    // Update neobrutalism intensity
    wp.customize('novaui_neobrutalism_intensity', function(value) {
        value.bind(function(newval) {
            // Remover todas las clases de intensidad existentes
            $('body').removeClass('neobrutalism-light neobrutalism-medium neobrutalism-strong');
            
            // Añadir la nueva clase de intensidad
            $('body').addClass('neobrutalism-' + newval);
            
            // Actualizar valores de sombra según la intensidad
            let shadowNormal, shadowLarge, shadowSmall;
            
            if (newval === 'light') {
                shadowNormal = '4px 4px 0 rgba(0, 0, 0, 0.05)';
                shadowLarge = '6px 6px 0 rgba(0, 0, 0, 0.05)';
                shadowSmall = '2px 2px 0 rgba(0, 0, 0, 0.05)';
            } else if (newval === 'medium') {
                shadowNormal = '6px 6px 0 rgba(0, 0, 0, 0.1)';
                shadowLarge = '8px 8px 0 rgba(0, 0, 0, 0.1)';
                shadowSmall = '4px 4px 0 rgba(0, 0, 0, 0.1)';
            } else if (newval === 'strong') {
                shadowNormal = '8px 8px 0 rgba(0, 0, 0, 0.15)';
                shadowLarge = '12px 12px 0 rgba(0, 0, 0, 0.15)';
                shadowSmall = '6px 6px 0 rgba(0, 0, 0, 0.15)';
            }
            
            document.documentElement.style.setProperty('--shadow-normal', shadowNormal);
            document.documentElement.style.setProperty('--shadow-large', shadowLarge);
            document.documentElement.style.setProperty('--shadow-small', shadowSmall);
        });
    });
    
    // Toggle game UI elements
    wp.customize('novaui_show_game_ui', function(value) {
        value.bind(function(newval) {
            if (newval) {
                $('.game-ui-element').show();
            } else {
                $('.game-ui-element').hide();
            }
        });
    });
    
    // Update primary font
    wp.customize('novaui_primary_font', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--font-primary', "'" + newval + "', sans-serif");
            
            // Cargar la fuente si no está ya cargada
            if (newval !== 'Jost' && newval !== 'Quicksand') {
                const fontUrl = 'https://fonts.googleapis.com/css2?family=' + newval.replace(' ', '+') + ':wght@300;400;500;600;700&display=swap';
                
                if (!$('link[href*="' + newval.replace(' ', '+') + '"]').length) {
                    $('head').append('<link href="' + fontUrl + '" rel="stylesheet">');
                }
            }
        });
    });
    
})(jQuery);
