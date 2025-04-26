<?php
/**
 * NovaUI Theme Customizer
 *
 * @package NovaUI
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function novaui_customize_register( $wp_customize ) {
    // Añadir nuestro panel personalizado
    $wp_customize->add_panel( 'novaui_theme_options', array(
        'title'       => esc_html__( 'NovaUI Theme Options', 'novaui' ),
        'description' => esc_html__( 'Customize your NovaUI theme with these options.', 'novaui' ),
        'priority'    => 150,
    ) );

    /**
     * Color Scheme Settings
     */
    $wp_customize->add_section( 'novaui_colors', array(
        'title'       => esc_html__( 'Colors', 'novaui' ),
        'description' => esc_html__( 'Customize the color scheme of your site.', 'novaui' ),
        'panel'       => 'novaui_theme_options',
        'priority'    => 10,
    ) );

    // Presets de color
    $wp_customize->add_setting( 'novaui_color_preset', array(
        'default'           => 'default',
        'sanitize_callback' => 'novaui_sanitize_select',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'novaui_color_preset', array(
        'label'       => esc_html__( 'Color Preset', 'novaui' ),
        'description' => esc_html__( 'Choose a predefined color scheme or customize your own.', 'novaui' ),
        'section'     => 'novaui_colors',
        'type'        => 'select',
        'choices'     => array(
            'default'    => esc_html__( 'Default (Soft Neubrutalism)', 'novaui' ),
            'blue'       => esc_html__( 'Blue', 'novaui' ),
            'green'      => esc_html__( 'Green', 'novaui' ),
            'purple'     => esc_html__( 'Purple', 'novaui' ),
            'monochrome' => esc_html__( 'Monochrome', 'novaui' ),
            'custom'     => esc_html__( 'Custom', 'novaui' ),
        ),
    ) );

    // Color Primario
    $wp_customize->add_setting( 'novaui_primary_color', array(
        'default'           => '#FF6B6B', // Coral
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'novaui_primary_color', array(
        'label'       => esc_html__( 'Primary Color', 'novaui' ),
        'description' => esc_html__( 'Used for buttons, links, and primary accents.', 'novaui' ),
        'section'     => 'novaui_colors',
    ) ) );

    // Color Secundario
    $wp_customize->add_setting( 'novaui_secondary_color', array(
        'default'           => '#4ECDC4', // Teal suave
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'novaui_secondary_color', array(
        'label'       => esc_html__( 'Secondary Color', 'novaui' ),
        'description' => esc_html__( 'Used for secondary UI elements.', 'novaui' ),
        'section'     => 'novaui_colors',
    ) ) );

    // Color de Acento
    $wp_customize->add_setting( 'novaui_accent_color', array(
        'default'           => '#FFE66D', // Amarillo cálido
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'novaui_accent_color', array(
        'label'       => esc_html__( 'Accent Color', 'novaui' ),
        'description' => esc_html__( 'Used for highlighting elements and badges.', 'novaui' ),
        'section'     => 'novaui_colors',
    ) ) );

    // Color de Éxito
    $wp_customize->add_setting( 'novaui_success_color', array(
        'default'           => '#7BC950', // Verde pastel
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'novaui_success_color', array(
        'label'       => esc_html__( 'Success Color', 'novaui' ),
        'description' => esc_html__( 'Used for success messages and indicators.', 'novaui' ),
        'section'     => 'novaui_colors',
    ) ) );

    // Color de Advertencia
    $wp_customize->add_setting( 'novaui_warning_color', array(
        'default'           => '#FFA552', // Naranja suave
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'novaui_warning_color', array(
        'label'       => esc_html__( 'Warning Color', 'novaui' ),
        'description' => esc_html__( 'Used for warning messages and indicators.', 'novaui' ),
        'section'     => 'novaui_colors',
    ) ) );

    // Color de Error
    $wp_customize->add_setting( 'novaui_error_color', array(
        'default'           => '#F76F8E', // Rosa-rojo suave
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'novaui_error_color', array(
        'label'       => esc_html__( 'Error Color', 'novaui' ),
        'description' => esc_html__( 'Used for error messages and indicators.', 'novaui' ),
        'section'     => 'novaui_colors',
    ) ) );

    // Color de Texto
    $wp_customize->add_setting( 'novaui_text_color', array(
        'default'           => '#505168', // Gris-púrpura oscuro
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'novaui_text_color', array(
        'label'       => esc_html__( 'Text Color', 'novaui' ),
        'description' => esc_html__( 'Used for main text content.', 'novaui' ),
        'section'     => 'novaui_colors',
    ) ) );

    // Color de Fondo
    $wp_customize->add_setting( 'novaui_background_color', array(
        'default'           => '#F7F9F9', // Blanco hueso
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'novaui_background_color', array(
        'label'       => esc_html__( 'Background Color', 'novaui' ),
        'description' => esc_html__( 'Used for main background.', 'novaui' ),
        'section'     => 'novaui_colors',
    ) ) );

    /**
     * Typography Settings
     */
    $wp_customize->add_section( 'novaui_typography', array(
        'title'       => esc_html__( 'Typography', 'novaui' ),
        'description' => esc_html__( 'Customize the fonts and text settings.', 'novaui' ),
        'panel'       => 'novaui_theme_options',
        'priority'    => 20,
    ) );

    // Fuente Principal
    $wp_customize->add_setting( 'novaui_font_primary', array(
        'default'           => "'Jost', 'Quicksand', sans-serif",
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'novaui_font_primary', array(
        'label'       => esc_html__( 'Primary Font', 'novaui' ),
        'description' => esc_html__( 'Used for main text content.', 'novaui' ),
        'section'     => 'novaui_typography',
        'type'        => 'select',
        'choices'     => array(
            "'Jost', 'Quicksand', sans-serif"     => esc_html__( 'Jost (Default)', 'novaui' ),
            "'Quicksand', 'Jost', sans-serif"     => esc_html__( 'Quicksand', 'novaui' ),
            "'Inter', sans-serif"                 => esc_html__( 'Inter', 'novaui' ),
            "'Poppins', sans-serif"               => esc_html__( 'Poppins', 'novaui' ),
            "'Montserrat', sans-serif"            => esc_html__( 'Montserrat', 'novaui' ),
            "'Roboto', sans-serif"                => esc_html__( 'Roboto', 'novaui' ),
            "'Open Sans', sans-serif"             => esc_html__( 'Open Sans', 'novaui' ),
        ),
    ) );

    // Fuente Secundaria
    $wp_customize->add_setting( 'novaui_font_secondary', array(
        'default'           => "'Jost', 'Quicksand', sans-serif",
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'novaui_font_secondary', array(
        'label'       => esc_html__( 'Secondary Font', 'novaui' ),
        'description' => esc_html__( 'Used for headings and titles.', 'novaui' ),
        'section'     => 'novaui_typography',
        'type'        => 'select',
        'choices'     => array(
            "'Jost', 'Quicksand', sans-serif"     => esc_html__( 'Jost (Default)', 'novaui' ),
            "'Quicksand', 'Jost', sans-serif"     => esc_html__( 'Quicksand', 'novaui' ),
            "'Inter', sans-serif"                 => esc_html__( 'Inter', 'novaui' ),
            "'Poppins', sans-serif"               => esc_html__( 'Poppins', 'novaui' ),
            "'Montserrat', sans-serif"            => esc_html__( 'Montserrat', 'novaui' ),
            "'Roboto', sans-serif"                => esc_html__( 'Roboto', 'novaui' ),
            "'Open Sans', sans-serif"             => esc_html__( 'Open Sans', 'novaui' ),
        ),
    ) );

    // Tamaño de Fuente Base
    $wp_customize->add_setting( 'novaui_font_size_base', array(
        'default'           => 14,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'novaui_font_size_base', array(
        'label'       => esc_html__( 'Base Font Size (px)', 'novaui' ),
        'description' => esc_html__( 'The base font size for the theme.', 'novaui' ),
        'section'     => 'novaui_typography',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 20,
            'step' => 1,
        ),
    ) );

    /**
     * Layout Settings
     */
    $wp_customize->add_section( 'novaui_layout', array(
        'title'       => esc_html__( 'Layout', 'novaui' ),
        'description' => esc_html__( 'Customize the layout settings.', 'novaui' ),
        'panel'       => 'novaui_theme_options',
        'priority'    => 30,
    ) );

    // Container Width
    $wp_customize->add_setting( 'novaui_container_width', array(
        'default'           => 1200,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'novaui_container_width', array(
        'label'       => esc_html__( 'Container Width (px)', 'novaui' ),
        'description' => esc_html__( 'The maximum width of the main content container.', 'novaui' ),
        'section'     => 'novaui_layout',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 800,
            'max'  => 1600,
            'step' => 10,
        ),
    ) );

    // Sidebar Width
    $wp_customize->add_setting( 'novaui_sidebar_width', array(
        'default'           => 250,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'novaui_sidebar_width', array(
        'label'       => esc_html__( 'Sidebar Width (px)', 'novaui' ),
        'description' => esc_html__( 'The width of the sidebar in dashboard layouts.', 'novaui' ),
        'section'     => 'novaui_layout',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 200,
            'max'  => 350,
            'step' => 10,
        ),
    ) );

    /**
     * Components Settings
     */
    $wp_customize->add_section( 'novaui_components', array(
        'title'       => esc_html__( 'Components', 'novaui' ),
        'description' => esc_html__( 'Customize the style of UI components.', 'novaui' ),
        'panel'       => 'novaui_theme_options',
        'priority'    => 40,
    ) );

    // Border Radius
    $wp_customize->add_setting( 'novaui_border_radius', array(
        'default'           => 8,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'novaui_border_radius', array(
        'label'       => esc_html__( 'Border Radius (px)', 'novaui' ),
        'description' => esc_html__( 'The default border radius for elements.', 'novaui' ),
        'section'     => 'novaui_components',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 24,
            'step' => 1,
        ),
    ) );

    // Border Width
    $wp_customize->add_setting( 'novaui_border_width', array(
        'default'           => 2,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'novaui_border_width', array(
        'label'       => esc_html__( 'Border Width (px)', 'novaui' ),
        'description' => esc_html__( 'The default border width for elements.', 'novaui' ),
        'section'     => 'novaui_components',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 4,
            'step' => 1,
        ),
    ) );

    // Shadow Intensity (Soft Neubrutalism)
    $wp_customize->add_setting( 'novaui_shadow_intensity', array(
        'default'           => 100,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'novaui_shadow_intensity', array(
        'label'       => esc_html__( 'Shadow Intensity (%)', 'novaui' ),
        'description' => esc_html__( 'The intensity of the Soft Neubrutalism shadow effect.', 'novaui' ),
        'section'     => 'novaui_components',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 150,
            'step' => 10,
        ),
    ) );

    /**
     * Theme Mode Settings
     */
    $wp_customize->add_section( 'novaui_theme_mode', array(
        'title'       => esc_html__( 'Theme Mode', 'novaui' ),
        'description' => esc_html__( 'Customize the dark/light mode settings.', 'novaui' ),
        'panel'       => 'novaui_theme_options',
        'priority'    => 50,
    ) );

    // Dark Mode Toggle
    $wp_customize->add_setting( 'novaui_dark_mode_toggle', array(
        'default'           => true,
        'sanitize_callback' => 'novaui_sanitize_checkbox',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'novaui_dark_mode_toggle', array(
        'label'       => esc_html__( 'Show Dark Mode Toggle', 'novaui' ),
        'description' => esc_html__( 'Show or hide the dark mode toggle button.', 'novaui' ),
        'section'     => 'novaui_theme_mode',
        'type'        => 'checkbox',
    ) );

    // Default Mode
    $wp_customize->add_setting( 'novaui_default_mode', array(
        'default'           => 'auto',
        'sanitize_callback' => 'novaui_sanitize_select',
    ) );

    $wp_customize->add_control( 'novaui_default_mode', array(
        'label'       => esc_html__( 'Default Theme Mode', 'novaui' ),
        'description' => esc_html__( 'Choose the default theme mode.', 'novaui' ),
        'section'     => 'novaui_theme_mode',
        'type'        => 'select',
        'choices'     => array(
            'auto'  => esc_html__( 'Auto (System Preference)', 'novaui' ),
            'light' => esc_html__( 'Light Mode', 'novaui' ),
            'dark'  => esc_html__( 'Dark Mode', 'novaui' ),
        ),
    ) );
}
add_action( 'customize_register', 'novaui_customize_register' );

/**
 * Sanitize select field
 */
function novaui_sanitize_select( $input, $setting ) {
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize checkbox
 */
function novaui_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function novaui_customize_preview_js() {
    wp_enqueue_script( 'novaui-customizer', get_template_directory_uri() . '/assets/js/theme-settings.js', array( 'customize-preview', 'jquery' ), NOVAUI_VERSION, true );
}
add_action( 'customize_preview_init', 'novaui_customize_preview_js' );

/**
 * Enqueue scripts for the color scheme customizer.
 */
function novaui_customizer_controls_js() {
    wp_enqueue_script( 'novaui-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array( 'customize-controls', 'jquery' ), NOVAUI_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'novaui_customizer_controls_js' );

/**
 * Generate and output the inline CSS based on customizer settings
 */
function novaui_customizer_css() {
    // Get color preset and determine whether to use custom colors
    $color_preset = get_theme_mod( 'novaui_color_preset', 'default' );
    
    // Set colors based on preset
    if ( $color_preset === 'default' ) {
        $primary_color   = '#FF6B6B'; // Coral
        $secondary_color = '#4ECDC4'; // Teal suave
        $accent_color    = '#FFE66D'; // Amarillo cálido
        $success_color   = '#7BC950'; // Verde pastel
        $warning_color   = '#FFA552'; // Naranja suave
        $error_color     = '#F76F8E'; // Rosa-rojo suave
    } elseif ( $color_preset === 'blue' ) {
        $primary_color   = '#3490dc';
        $secondary_color = '#64D2FF';
        $accent_color    = '#FFCE54';
        $success_color   = '#38c172';
        $warning_color   = '#ffce54';
        $error_color     = '#e3342f';
    } elseif ( $color_preset === 'green' ) {
        $primary_color   = '#38c172';
        $secondary_color = '#4CAF50';
        $accent_color    = '#FFCE54';
        $success_color   = '#38c172';
        $warning_color   = '#F39C12';
        $error_color     = '#e3342f';
    } elseif ( $color_preset === 'purple' ) {
        $primary_color   = '#9561e2';
        $secondary_color = '#6772E5';
        $accent_color    = '#F66D9B';
        $success_color   = '#38c172';
        $warning_color   = '#ffce54';
        $error_color     = '#e3342f';
    } elseif ( $color_preset === 'monochrome' ) {
        $primary_color   = '#2D3748';
        $secondary_color = '#4A5568';
        $accent_color    = '#718096';
        $success_color   = '#38c172';
        $warning_color   = '#ffce54';
        $error_color     = '#e3342f';
    } else {
        // Custom colors, get from theme mods
        $primary_color   = get_theme_mod( 'novaui_primary_color', '#FF6B6B' );
        $secondary_color = get_theme_mod( 'novaui_secondary_color', '#4ECDC4' );
        $accent_color    = get_theme_mod( 'novaui_accent_color', '#FFE66D' );
        $success_color   = get_theme_mod( 'novaui_success_color', '#7BC950' );
        $warning_color   = get_theme_mod( 'novaui_warning_color', '#FFA552' );
        $error_color     = get_theme_mod( 'novaui_error_color', '#F76F8E' );
    }
    
    // Get other theme mods
    $text_color      = get_theme_mod( 'novaui_text_color', '#505168' );
    $bg_color        = get_theme_mod( 'novaui_background_color', '#F7F9F9' );
    $font_primary    = get_theme_mod( 'novaui_font_primary', "'Jost', 'Quicksand', sans-serif" );
    $font_secondary  = get_theme_mod( 'novaui_font_secondary', "'Jost', 'Quicksand', sans-serif" );
    $font_size_base  = get_theme_mod( 'novaui_font_size_base', 14 );
    $container_width = get_theme_mod( 'novaui_container_width', 1200 );
    $sidebar_width   = get_theme_mod( 'novaui_sidebar_width', 250 );
    $border_radius   = get_theme_mod( 'novaui_border_radius', 8 );
    $border_width    = get_theme_mod( 'novaui_border_width', 2 );
    $shadow_intensity = get_theme_mod( 'novaui_shadow_intensity', 100 ) / 100;
    $dark_mode_toggle = get_theme_mod( 'novaui_dark_mode_toggle', true );
    
    // Calcular colores derivados
    $primary_hover = novaui_adjust_brightness( $primary_color, -15 );
    $primary_active = novaui_adjust_brightness( $primary_color, -25 );
    $secondary_hover = novaui_adjust_brightness( $secondary_color, -15 );
    $secondary_active = novaui_adjust_brightness( $secondary_color, -25 );
    $text_light = novaui_adjust_brightness( $text_color, 30 );
    $bg_alt = novaui_adjust_brightness( $bg_color, -3 );
    $border_color = novaui_adjust_brightness( $bg_color, -10 );
    
    // Generar CSS
    $css = "
    :root {
        --color-primary: {$primary_color};
        --color-primary-hover: {$primary_hover};
        --color-primary-active: {$primary_active};
        --color-secondary: {$secondary_color};
        --color-secondary-hover: {$secondary_hover};
        --color-secondary-active: {$secondary_active};
        --color-accent: {$accent_color};
        --color-success: {$success_color};
        --color-warning: {$warning_color};
        --color-error: {$error_color};
        --color-text: {$text_color};
        --color-text-light: {$text_light};
        --color-background: {$bg_color};
        --color-background-alt: {$bg_alt};
        --color-link: {$primary_color};
        --color-link-hover: {$primary_hover};
        --border-color: {$border_color};
        
        --font-primary: {$font_primary};
        --font-secondary: {$font_secondary};
        --font-size-base: {$font_size_base}px;
        
        --container-width: {$container_width}px;
        --sidebar-width: {$sidebar_width}px;
        --sidebar-collapsed-width: 70px;
        
        --border-radius-sm: " . ($border_radius / 2) . "px;
        --border-radius-md: {$border_radius}px;
        --border-radius-lg: " . ($border_radius * 1.5) . "px;
        --border-width: {$border_width}px;
        
        --shadow-sm: " . round(3 * $shadow_intensity) . "px " . round(3 * $shadow_intensity) . "px 0 rgba(0, 0, 0, " . (0.05 * $shadow_intensity) . ");
        --shadow-md: " . round(6 * $shadow_intensity) . "px " . round(6 * $shadow_intensity) . "px 0 rgba(0, 0, 0, " . (0.1 * $shadow_intensity) . ");
        --shadow-lg: " . round(8 * $shadow_intensity) . "px " . round(8 * $shadow_intensity) . "px 0 rgba(0, 0, 0, " . (0.15 * $shadow_intensity) . ");
        
        --theme-toggle-visibility: " . ($dark_mode_toggle ? 'visible' : 'hidden') . ";
    }
    ";
    
    // Aplicar el CSS si hay cambios
    if ( !empty( $css ) ) {
        wp_add_inline_style( 'novaui-style', $css );
    }
}
add_action( 'wp_enqueue_scripts', 'novaui_customizer_css', 20 );

/**
 * Utility function to adjust the brightness of a color
 */
function novaui_adjust_brightness( $hex, $steps ) {
    $steps = max( -255, min( 255, $steps ) );
    
    $hex = str_replace( '#', '', $hex );
    
    if ( strlen( $hex ) == 3 ) {
        $hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
    }
    
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );
    
    $r = max( 0, min( 255, $r + $steps ) );
    $g = max( 0, min( 255, $g + $steps ) );
    $b = max( 0, min( 255, $b + $steps ) );
    
    return '#' . sprintf( '%02x', $r ) . sprintf( '%02x', $g ) . sprintf( '%02x', $b );
}
