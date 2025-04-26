<?php
/**
 * NovaUI Theme Customizer
 *
 * @package NovaUI
 */

/**
 * Añadir configuraciones de personalización para el tema.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function novaui_customize_register($wp_customize) {
    // Añadir sección para opciones de NovaUI
    $wp_customize->add_section('novaui_options', array(
        'title'       => __('Opciones de NovaUI', 'novaui'),
        'description' => __('Personaliza tu tema NovaUI', 'novaui'),
        'priority'    => 130,
    ));

    // Opción para modo claro/oscuro por defecto
    $wp_customize->add_setting('novaui_default_theme_mode', array(
        'default'           => 'auto',
        'transport'         => 'refresh',
        'sanitize_callback' => 'novaui_sanitize_select',
    ));

    $wp_customize->add_control('novaui_default_theme_mode', array(
        'label'       => __('Modo de tema por defecto', 'novaui'),
        'section'     => 'novaui_options',
        'type'        => 'select',
        'choices'     => array(
            'auto'  => __('Automático (según preferencia del sistema)', 'novaui'),
            'light' => __('Claro', 'novaui'),
            'dark'  => __('Oscuro', 'novaui'),
        ),
    ));

    // Personalización de color primario
    $wp_customize->add_setting('novaui_primary_color', array(
        'default'           => '#FF6B6B',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'novaui_primary_color', array(
        'label'       => __('Color Primario', 'novaui'),
        'description' => __('Color principal para botones, enlaces y elementos destacados', 'novaui'),
        'section'     => 'novaui_options',
    )));

    // Personalización de color secundario
    $wp_customize->add_setting('novaui_secondary_color', array(
        'default'           => '#4ECDC4',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'novaui_secondary_color', array(
        'label'       => __('Color Secundario', 'novaui'),
        'description' => __('Color secundario para detalles y elementos complementarios', 'novaui'),
        'section'     => 'novaui_options',
    )));

    // Personalización de color de acento
    $wp_customize->add_setting('novaui_accent_color', array(
        'default'           => '#FFE66D',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'novaui_accent_color', array(
        'label'       => __('Color de Acento', 'novaui'),
        'description' => __('Color de acento para detalles y elementos destacados secundarios', 'novaui'),
        'section'     => 'novaui_options',
    )));

    // Opción para intensidad del estilo Neobrutalism
    $wp_customize->add_setting('novaui_neobrutalism_intensity', array(
        'default'           => 'medium',
        'transport'         => 'refresh',
        'sanitize_callback' => 'novaui_sanitize_select',
    ));

    $wp_customize->add_control('novaui_neobrutalism_intensity', array(
        'label'       => __('Intensidad del estilo Neobrutalism', 'novaui'),
        'description' => __('Controla la intensidad de los elementos visuales neobrutalism como sombras, bordes, etc.', 'novaui'),
        'section'     => 'novaui_options',
        'type'        => 'select',
        'choices'     => array(
            'light'  => __('Suave', 'novaui'),
            'medium' => __('Medio', 'novaui'),
            'strong' => __('Intenso', 'novaui'),
        ),
    ));

    // Opción para mostrar/ocultar elementos de UI de juego
    $wp_customize->add_setting('novaui_show_game_ui', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'novaui_sanitize_checkbox',
    ));

    $wp_customize->add_control('novaui_show_game_ui', array(
        'label'       => __('Mostrar elementos de UI de videojuego', 'novaui'),
        'description' => __('Activa o desactiva los elementos visuales inspirados en interfaces de videojuegos', 'novaui'),
        'section'     => 'novaui_options',
        'type'        => 'checkbox',
    ));

    // Opción para la fuente principal
    $wp_customize->add_setting('novaui_primary_font', array(
        'default'           => 'Jost',
        'transport'         => 'refresh',
        'sanitize_callback' => 'novaui_sanitize_select',
    ));

    $wp_customize->add_control('novaui_primary_font', array(
        'label'       => __('Fuente Principal', 'novaui'),
        'section'     => 'novaui_options',
        'type'        => 'select',
        'choices'     => array(
            'Jost'       => 'Jost',
            'Quicksand'  => 'Quicksand',
            'Poppins'    => 'Poppins',
            'Montserrat' => 'Montserrat',
            'Roboto'     => 'Roboto',
        ),
    ));
}
add_action('customize_register', 'novaui_customize_register');

/**
 * Función de sanitización para campos select
 */
function novaui_sanitize_select($input, $setting) {
    // Obtener la lista de opciones posibles
    $choices = $setting->manager->get_control($setting->id)->choices;
    
    // Devolver la opción seleccionada o el valor por defecto
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Función de sanitización para campos checkbox
 */
function novaui_sanitize_checkbox($input) {
    return (isset($input) && true == $input) ? true : false;
}

/**
 * Renderizar CSS personalizado en base a las opciones del customizer
 */
function novaui_customizer_css() {
    // Obtener colores personalizados
    $primary_color = get_theme_mod('novaui_primary_color', '#FF6B6B');
    $secondary_color = get_theme_mod('novaui_secondary_color', '#4ECDC4');
    $accent_color = get_theme_mod('novaui_accent_color', '#FFE66D');
    
    // Obtener intensidad del neobrutalism
    $neobrutalism_intensity = get_theme_mod('novaui_neobrutalism_intensity', 'medium');
    
    // Determinar valores de sombra según intensidad
    $shadow_values = array(
        'light'  => '4px 4px 0 rgba(0, 0, 0, 0.05)',
        'medium' => '6px 6px 0 rgba(0, 0, 0, 0.1)',
        'strong' => '8px 8px 0 rgba(0, 0, 0, 0.15)',
    );
    
    $shadow_normal = $shadow_values[$neobrutalism_intensity];
    $shadow_large = str_replace('6px 6px', '8px 8px', $shadow_normal);
    $shadow_small = str_replace('6px 6px', '4px 4px', $shadow_normal);
    
    // Obtener fuente principal
    $primary_font = get_theme_mod('novaui_primary_font', 'Jost');
    
    // Construir CSS personalizado
    $css = "
        :root {
            --color-primary: {$primary_color};
            --color-secondary: {$secondary_color};
            --color-accent: {$accent_color};
            --shadow-normal: {$shadow_normal};
            --shadow-large: {$shadow_large};
            --shadow-small: {$shadow_small};
            --font-primary: '{$primary_font}', sans-serif;
        }
        
        a, .text-primary {
            color: {$primary_color};
        }
        
        a:hover {
            color: " . novaui_adjust_brightness($primary_color, -20) . ";
        }
        
        .bg-primary, .button, .page-action-btn-primary {
            background-color: {$primary_color};
            border-color: {$primary_color};
        }
        
        .bg-secondary, .button-secondary {
            background-color: {$secondary_color};
            border-color: {$secondary_color};
        }
        
        .bg-accent, .button-accent {
            background-color: {$accent_color};
            border-color: {$accent_color};
        }
        
        .dashboard-brand-accent, .widget-title-icon, .nova-brand-accent {
            color: {$primary_color};
        }
        
        .dashboard-logo, .user-avatar, .chat-send {
            background-color: {$primary_color};
        }
        
        .dashboard-nav-link.active .dashboard-nav-icon {
            color: {$primary_color};
        }
    ";
    
    // Si los elementos de UI de juego están desactivados, ocultar esos elementos
    if (!get_theme_mod('novaui_show_game_ui', true)) {
        $css .= "
            .game-ui-element {
                display: none !important;
            }
        ";
    }
    
    // Imprimir CSS
    echo '<style type="text/css">' . $css . '</style>';
}
add_action('wp_head', 'novaui_customizer_css');

/**
 * Ajustar brillo de un color hexadecimal
 */
function novaui_adjust_brightness($hex, $steps) {
    // Quitar el # si está presente
    $hex = ltrim($hex, '#');
    
    // Convertir a RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    // Ajustar brillo
    $r = max(0, min(255, $r + $steps));
    $g = max(0, min(255, $g + $steps));
    $b = max(0, min(255, $b + $steps));
    
    // Convertir de vuelta a hexadecimal
    return '#' . sprintf('%02x', $r) . sprintf('%02x', $g) . sprintf('%02x', $b);
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function novaui_customize_preview_js() {
    wp_enqueue_script('novaui-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), NOVAUI_VERSION, true);
}
add_action('customize_preview_init', 'novaui_customize_preview_js');
