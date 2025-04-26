<?php
/**
 * NovaUI Theme Customizer
 *
 * @package NovaUI
 */

/**
 * Agregar configuraciones al personalizador.
 *
 * @param WP_Customize_Manager $wp_customize Objeto del personalizador de WordPress.
 */
function nova_ui_customize_register( $wp_customize ) {
    // Añadir panel para opciones de NovaUI
    $wp_customize->add_panel( 'nova_ui_theme_options', array(
        'title'    => esc_html__( 'NovaUI Theme Options', 'nova-ui' ),
        'priority' => 130,
    ) );

    // Añadir sección para ajustes generales
    $wp_customize->add_section( 'nova_ui_general_settings', array(
        'title'    => esc_html__( 'General Settings', 'nova-ui' ),
        'priority' => 10,
        'panel'    => 'nova_ui_theme_options',
    ) );

    // Añadir campo para el modo oscuro predeterminado
    $wp_customize->add_setting( 'nova_ui_default_dark_mode', array(
        'default'           => false,
        'sanitize_callback' => 'nova_ui_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'nova_ui_default_dark_mode', array(
        'type'        => 'checkbox',
        'section'     => 'nova_ui_general_settings',
        'label'       => esc_html__( 'Enable Dark Mode by Default', 'nova-ui' ),
        'description' => esc_html__( 'When checked, the site will load in dark mode by default.', 'nova-ui' ),
    ) );

    // Añadir campo para mostrar/ocultar toggle de tema
    $wp_customize->add_setting( 'nova_ui_show_dark_mode_toggle', array(
        'default'           => true,
        'sanitize_callback' => 'nova_ui_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'nova_ui_show_dark_mode_toggle', array(
        'type'        => 'checkbox',
        'section'     => 'nova_ui_general_settings',
        'label'       => esc_html__( 'Show Dark Mode Toggle', 'nova-ui' ),
        'description' => esc_html__( 'When checked, users will see a toggle to switch between light and dark mode.', 'nova-ui' ),
    ) );

    // Añadir sección para colores
    $wp_customize->add_section( 'nova_ui_colors', array(
        'title'    => esc_html__( 'Theme Colors', 'nova-ui' ),
        'priority' => 20,
        'panel'    => 'nova_ui_theme_options',
    ) );

    // Color primario
    $wp_customize->add_setting( 'nova_ui_primary_color', array(
        'default'           => '#FF6B6B',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nova_ui_primary_color', array(
        'section'     => 'nova_ui_colors',
        'label'       => esc_html__( 'Primary Color', 'nova-ui' ),
        'description' => esc_html__( 'Main accent color used for buttons, links, and highlighted elements.', 'nova-ui' ),
    ) ) );

    // Color secundario
    $wp_customize->add_setting( 'nova_ui_secondary_color', array(
        'default'           => '#4ECDC4',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nova_ui_secondary_color', array(
        'section'     => 'nova_ui_colors',
        'label'       => esc_html__( 'Secondary Color', 'nova-ui' ),
        'description' => esc_html__( 'Secondary color used for various elements.', 'nova-ui' ),
    ) ) );

    // Color de acento
    $wp_customize->add_setting( 'nova_ui_accent_color', array(
        'default'           => '#FFE66D',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nova_ui_accent_color', array(
        'section'     => 'nova_ui_colors',
        'label'       => esc_html__( 'Accent Color', 'nova-ui' ),
        'description' => esc_html__( 'Used for highlighting special elements and badges.', 'nova-ui' ),
    ) ) );

    // Añadir sección para tipografía
    $wp_customize->add_section( 'nova_ui_typography', array(
        'title'    => esc_html__( 'Typography', 'nova-ui' ),
        'priority' => 30,
        'panel'    => 'nova_ui_theme_options',
    ) );

    // Fuente principal
    $wp_customize->add_setting( 'nova_ui_primary_font', array(
        'default'           => 'Jost, Quicksand, sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'nova_ui_primary_font', array(
        'type'        => 'select',
        'section'     => 'nova_ui_typography',
        'label'       => esc_html__( 'Primary Font', 'nova-ui' ),
        'description' => esc_html__( 'Main font used throughout the site.', 'nova-ui' ),
        'choices'     => array(
            'Jost, Quicksand, sans-serif'      => esc_html__( 'Jost (Default)', 'nova-ui' ),
            'Quicksand, Jost, sans-serif'      => esc_html__( 'Quicksand', 'nova-ui' ),
            'Roboto, sans-serif'               => esc_html__( 'Roboto', 'nova-ui' ),
            'Open Sans, sans-serif'            => esc_html__( 'Open Sans', 'nova-ui' ),
            'Montserrat, sans-serif'           => esc_html__( 'Montserrat', 'nova-ui' ),
            'Poppins, sans-serif'              => esc_html__( 'Poppins', 'nova-ui' ),
        ),
    ) );

    // Tamaño de fuente base
    $wp_customize->add_setting( 'nova_ui_base_font_size', array(
        'default'           => '16px',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'nova_ui_base_font_size', array(
        'type'        => 'select',
        'section'     => 'nova_ui_typography',
        'label'       => esc_html__( 'Base Font Size', 'nova-ui' ),
        'description' => esc_html__( 'Base font size for text. Other elements will scale accordingly.', 'nova-ui' ),
        'choices'     => array(
            '14px' => esc_html__( 'Small (14px)', 'nova-ui' ),
            '16px' => esc_html__( 'Medium (16px) - Default', 'nova-ui' ),
            '18px' => esc_html__( 'Large (18px)', 'nova-ui' ),
            '20px' => esc_html__( 'Extra Large (20px)', 'nova-ui' ),
        ),
    ) );

    // Añadir sección para layout
    $wp_customize->add_section( 'nova_ui_layout', array(
        'title'    => esc_html__( 'Layout', 'nova-ui' ),
        'priority' => 40,
        'panel'    => 'nova_ui_theme_options',
    ) );

    // Ancho del contenedor
    $wp_customize->add_setting( 'nova_ui_container_width', array(
        'default'           => '1280px',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'nova_ui_container_width', array(
        'type'        => 'select',
        'section'     => 'nova_ui_layout',
        'label'       => esc_html__( 'Container Width', 'nova-ui' ),
        'description' => esc_html__( 'Maximum width of the main content area.', 'nova-ui' ),
        'choices'     => array(
            '1140px' => esc_html__( 'Compact (1140px)', 'nova-ui' ),
            '1280px' => esc_html__( 'Default (1280px)', 'nova-ui' ),
            '1440px' => esc_html__( 'Wide (1440px)', 'nova-ui' ),
            '1600px' => esc_html__( 'Extra Wide (1600px)', 'nova-ui' ),
        ),
    ) );

    // Mostrar barra lateral por defecto
    $wp_customize->add_setting( 'nova_ui_show_sidebar', array(
        'default'           => true,
        'sanitize_callback' => 'nova_ui_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'nova_ui_show_sidebar', array(
        'type'        => 'checkbox',
        'section'     => 'nova_ui_layout',
        'label'       => esc_html__( 'Show Sidebar by Default', 'nova-ui' ),
        'description' => esc_html__( 'When checked, pages will show the sidebar by default (unless using a specific template).', 'nova-ui' ),
    ) );

    // Añadir sección para footer
    $wp_customize->add_section( 'nova_ui_footer', array(
        'title'    => esc_html__( 'Footer', 'nova-ui' ),
        'priority' => 50,
        'panel'    => 'nova_ui_theme_options',
    ) );

    // Texto del footer
    $wp_customize->add_setting( 'nova_ui_footer_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'nova_ui_footer_text', array(
        'type'        => 'textarea',
        'section'     => 'nova_ui_footer',
        'label'       => esc_html__( 'Footer Text', 'nova-ui' ),
        'description' => esc_html__( 'Text to display in the footer. Leave empty to use the default.', 'nova-ui' ),
    ) );

    // Añadir sección para características adicionales
    $wp_customize->add_section( 'nova_ui_features', array(
        'title'    => esc_html__( 'Additional Features', 'nova-ui' ),
        'priority' => 60,
        'panel'    => 'nova_ui_theme_options',
    ) );

    // Habilitar efecto de sombra neo-brutalista
    $wp_customize->add_setting( 'nova_ui_enable_neobrutal_shadow', array(
        'default'           => true,
        'sanitize_callback' => 'nova_ui_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'nova_ui_enable_neobrutal_shadow', array(
        'type'        => 'checkbox',
        'section'     => 'nova_ui_features',
        'label'       => esc_html__( 'Enable Neo-Brutalist Shadows', 'nova-ui' ),
        'description' => esc_html__( 'When checked, elements will have the characteristic offset shadows of neo-brutalist design.', 'nova-ui' ),
    ) );

    // Habilitar animaciones
    $wp_customize->add_setting( 'nova_ui_enable_animations', array(
        'default'           => true,
        'sanitize_callback' => 'nova_ui_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'nova_ui_enable_animations', array(
        'type'        => 'checkbox',
        'section'     => 'nova_ui_features',
        'label'       => esc_html__( 'Enable UI Animations', 'nova-ui' ),
        'description' => esc_html__( 'When checked, UI elements will have subtle animations. Disable for better performance on low-end devices.', 'nova-ui' ),
    ) );

    // Opciones para el dashboard
    $wp_customize->add_section( 'nova_ui_dashboard', array(
        'title'    => esc_html__( 'Dashboard', 'nova-ui' ),
        'priority' => 70,
        'panel'    => 'nova_ui_theme_options',
    ) );

    // Colapsar sidebar por defecto
    $wp_customize->add_setting( 'nova_ui_collapse_sidebar', array(
        'default'           => false,
        'sanitize_callback' => 'nova_ui_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'nova_ui_collapse_sidebar', array(
        'type'        => 'checkbox',
        'section'     => 'nova_ui_dashboard',
        'label'       => esc_html__( 'Collapse Sidebar by Default', 'nova-ui' ),
        'description' => esc_html__( 'When checked, the dashboard sidebar will be collapsed by default.', 'nova-ui' ),
    ) );
}
add_action( 'customize_register', 'nova_ui_customize_register' );

/**
 * Sanitiza valores booleanos para campos checkbox.
 *
 * @param bool $checked Si el checkbox está marcado.
 * @return bool Valor sanitizado.
 */
function nova_ui_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Genera CSS dinámico basado en las opciones del personalizador
 */
function nova_ui_customizer_css() {
    ?>
    <style type="text/css">
        :root {
            /* Colores personalizados */
            --color-primary: <?php echo esc_attr( get_theme_mod( 'nova_ui_primary_color', '#FF6B6B' ) ); ?>;
            --color-secondary: <?php echo esc_attr( get_theme_mod( 'nova_ui_secondary_color', '#4ECDC4' ) ); ?>;
            --color-accent: <?php echo esc_attr( get_theme_mod( 'nova_ui_accent_color', '#FFE66D' ) ); ?>;
            
            /* Estados del color primario - calculados */
            --color-primary-hover: <?php 
                $primary_color = get_theme_mod( 'nova_ui_primary_color', '#FF6B6B' );
                // Oscurecer en un 10% para hover
                echo esc_attr( nova_ui_adjust_brightness( $primary_color, -10 ) ); 
            ?>;
            --color-primary-active: <?php 
                // Oscurecer en un 15% para active
                echo esc_attr( nova_ui_adjust_brightness( $primary_color, -15 ) ); 
            ?>;
            
            /* Tipografía */
            --font-primary: <?php echo esc_attr( get_theme_mod( 'nova_ui_primary_font', 'Jost, Quicksand, sans-serif' ) ); ?>;
            --font-size-base: <?php echo esc_attr( get_theme_mod( 'nova_ui_base_font_size', '16px' ) ); ?>;
            
            /* Layout */
            --container-width: <?php echo esc_attr( get_theme_mod( 'nova_ui_container_width', '1280px' ) ); ?>;
            
            /* Sombras neo-brutalistas */
            <?php if ( get_theme_mod( 'nova_ui_enable_neobrutal_shadow', true ) ) : ?>
                --shadow-md: 6px 6px 0 rgba(0, 0, 0, 0.1);
                --shadow-lg: 10px 10px 0 rgba(0, 0, 0, 0.1);
            <?php else : ?>
                --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
                --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            <?php endif; ?>
            
            /* Animaciones */
            <?php if ( ! get_theme_mod( 'nova_ui_enable_animations', true ) ) : ?>
                --transition-fast: 0s;
                --transition-normal: 0s;
                --transition-slow: 0s;
            <?php endif; ?>
        }
        
        /* Ajustes para modo oscuro */
        @media (prefers-color-scheme: dark) {
            :root {
                <?php if ( get_theme_mod( 'nova_ui_enable_neobrutal_shadow', true ) ) : ?>
                    --shadow-md: 3px 3px 0 rgba(0, 0, 0, 0.3);
                    --shadow-lg: 5px 5px 0 rgba(0, 0, 0, 0.3);
                <?php else : ?>
                    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.3);
                    --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.3);
                <?php endif; ?>
            }
        }
        
        /* Modo oscuro por defecto */
        <?php if ( get_theme_mod( 'nova_ui_default_dark_mode', false ) ) : ?>
        html {
            --color-text: #E0E0E0;
            --color-text-light: #A0AEC0;
            --color-background: #2A2D45;
            --color-background-alt: #343A5E;
            --color-border: #3F4577;
            
            --color-link: #63B3ED;
            --color-link-hover: #90CDF4;
            
            --color-gray-100: #3F4577;
            --color-gray-200: #4E56A6;
            --color-gray-300: #5D68D5;
            --color-gray-400: #7F8AE5;
            --color-gray-500: #A0A9EB;
            --color-gray-600: #C1C6F0;
            --color-gray-700: #D8DCF5;
            --color-gray-800: #EDF0FB;
            --color-gray-900: #FFFFFF;
            
            <?php if ( get_theme_mod( 'nova_ui_enable_neobrutal_shadow', true ) ) : ?>
                --shadow-sm: 2px 2px 0 rgba(0, 0, 0, 0.3);
                --shadow-md: 3px 3px 0 rgba(0, 0, 0, 0.3);
                --shadow-lg: 5px 5px 0 rgba(0, 0, 0, 0.3);
                --shadow-focus: 0 0 0 3px rgba(79, 205, 196, 0.5);
            <?php else : ?>
                --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.3);
                --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.3);
                --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.3);
                --shadow-focus: 0 0 0 3px rgba(79, 205, 196, 0.5);
            <?php endif; ?>
            
            --header-background: var(--color-background);
            --footer-background: var(--color-background-alt);
            --sidebar-background: var(--color-background-alt);
            --card-background: var(--color-background-alt);
            --input-background: var(--color-background);
            --input-border: var(--color-border);
        }
        <?php endif; ?>
        
        /* Ocultar Toggle de Tema */
        <?php if ( ! get_theme_mod( 'nova_ui_show_dark_mode_toggle', true ) ) : ?>
        #dark-mode-toggle {
            display: none !important;
        }
        <?php endif; ?>
        
        /* Colapsar sidebar por defecto (para dashboard) */
        <?php if ( get_theme_mod( 'nova_ui_collapse_sidebar', false ) ) : ?>
        .dashboard-sidebar {
            flex-basis: var(--sidebar-collapsed-width);
        }
        <?php endif; ?>
        
        /* Custom footer text */
        <?php if ( get_theme_mod( 'nova_ui_footer_text', '' ) ) : ?>
        .site-info {
            display: none;
        }
        <?php endif; ?>
    </style>
    <?php
}
add_action( 'wp_head', 'nova_ui_customizer_css' );

/**
 * Ajusta el brillo de un color hexadecimal
 *
 * @param string $hex Color hexadecimal
 * @param int $steps Pasos para ajustar (-255 a 255)
 * @return string Color hexadecimal ajustado
 */
function nova_ui_adjust_brightness( $hex, $steps ) {
    // Quitar # si existe
    $hex = ltrim( $hex, '#' );
    
    // Convertir a RGB
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );
    
    // Ajustar brillo
    $r = max( 0, min( 255, $r + $steps ) );
    $g = max( 0, min( 255, $g + $steps ) );
    $b = max( 0, min( 255, $b + $steps ) );
    
    // Convertir de nuevo a hexadecimal
    $r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
    $g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
    $b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );
    
    return '#' . $r_hex . $g_hex . $b_hex;
}

/**
 * Agregar script para preview en tiempo real del personalizador
 */
function nova_ui_customize_preview_js() {
    wp_enqueue_script( 'nova-ui-customizer', get_template_directory_uri() . '/assets/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), NOVAUI_VERSION, true );
}
add_action( 'customize_preview_init', 'nova_ui_customize_preview_js' );
