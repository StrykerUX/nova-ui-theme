<?php
/**
 * NovaUI Theme Customizer
 *
 * @package NovaUI
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Incluir archivos adicionales de customizer
 */
function novaui_include_customizer_files() {
    // Panel de Colores
    require_once NOVAUI_THEME_DIR . '/inc/customizer/colors.php';
    
    // Panel de Tipografía
    require_once NOVAUI_THEME_DIR . '/inc/customizer/typography.php';
    
    // Panel de Header
    require_once NOVAUI_THEME_DIR . '/inc/customizer/header.php';
    
    // Panel de Footer
    require_once NOVAUI_THEME_DIR . '/inc/customizer/footer.php';
    
    // Panel de Layout
    require_once NOVAUI_THEME_DIR . '/inc/customizer/layout.php';
    
    // Panel de Botones y Componentes
    require_once NOVAUI_THEME_DIR . '/inc/customizer/components.php';
}
add_action( 'after_setup_theme', 'novaui_include_customizer_files' );

/**
 * Añadir configuración del tema al customizer de WordPress
 *
 * @param WP_Customize_Manager $wp_customize Objeto del customizer
 */
function novaui_customize_register( $wp_customize ) {
    /**
     * Panel principal de NovaUI
     */
    $wp_customize->add_panel( 'novaui_theme_panel', array(
        'title'       => __( 'NovaUI Theme Settings', 'novaui' ),
        'description' => __( 'Customize your theme appearance and behavior', 'novaui' ),
        'priority'    => 10,
    ) );
    
    /**
     * Sección: Opciones generales
     */
    $wp_customize->add_section( 'novaui_general_options', array(
        'title'       => __( 'General Options', 'novaui' ),
        'description' => __( 'Configure general theme settings', 'novaui' ),
        'panel'       => 'novaui_theme_panel',
        'priority'    => 10,
    ) );
    
    // Opción: Tema oscuro por defecto
    $wp_customize->add_setting( 'default_dark_mode', array(
        'default'           => false,
        'sanitize_callback' => 'novaui_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'default_dark_mode', array(
        'label'       => __( 'Use Dark Mode by Default', 'novaui' ),
        'description' => __( 'Enable dark mode as the default theme style', 'novaui' ),
        'section'     => 'novaui_general_options',
        'type'        => 'checkbox',
    ) );
    
    // Opción: Mostrar toggle de tema claro/oscuro
    $wp_customize->add_setting( 'show_dark_mode_toggle', array(
        'default'           => true,
        'sanitize_callback' => 'novaui_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'show_dark_mode_toggle', array(
        'label'       => __( 'Show Dark Mode Toggle', 'novaui' ),
        'description' => __( 'Display dark/light mode toggle in header', 'novaui' ),
        'section'     => 'novaui_general_options',
        'type'        => 'checkbox',
    ) );
    
    // Opción: Detectar tema del sistema
    $wp_customize->add_setting( 'detect_system_theme', array(
        'default'           => true,
        'sanitize_callback' => 'novaui_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'detect_system_theme', array(
        'label'       => __( 'Detect System Theme Preference', 'novaui' ),
        'description' => __( 'Use system dark/light mode preference automatically', 'novaui' ),
        'section'     => 'novaui_general_options',
        'type'        => 'checkbox',
    ) );
    
    // Opción: Estilos de dashboard
    $wp_customize->add_setting( 'dashboard_style', array(
        'default'           => 'soft-neobrutalism',
        'sanitize_callback' => 'novaui_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'dashboard_style', array(
        'label'       => __( 'Dashboard UI Style', 'novaui' ),
        'description' => __( 'Select the visual style for dashboard pages', 'novaui' ),
        'section'     => 'novaui_general_options',
        'type'        => 'select',
        'choices'     => array(
            'soft-neobrutalism' => __( 'Soft Neobrutalism (Default)', 'novaui' ),
            'minimal'           => __( 'Minimal', 'novaui' ),
            'classic'           => __( 'Classic', 'novaui' ),
        ),
    ) );
    
    /**
     * Sección: Opciones de WooCommerce
     * Solo visible si WooCommerce está activado
     */
    if ( class_exists( 'WooCommerce' ) ) {
        $wp_customize->add_section( 'novaui_woocommerce_options', array(
            'title'       => __( 'WooCommerce Options', 'novaui' ),
            'description' => __( 'Customize WooCommerce integration', 'novaui' ),
            'panel'       => 'novaui_theme_panel',
            'priority'    => 90,
        ) );
        
        // Opción: Estilo de productos
        $wp_customize->add_setting( 'woocommerce_product_style', array(
            'default'           => 'card',
            'sanitize_callback' => 'novaui_sanitize_select',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( 'woocommerce_product_style', array(
            'label'       => __( 'Product Display Style', 'novaui' ),
            'description' => __( 'Choose how products are displayed in shop pages', 'novaui' ),
            'section'     => 'novaui_woocommerce_options',
            'type'        => 'select',
            'choices'     => array(
                'card'    => __( 'Card Style', 'novaui' ),
                'minimal' => __( 'Minimal Style', 'novaui' ),
                'compact' => __( 'Compact Style', 'novaui' ),
            ),
        ) );
        
        // Opción: Checkout personalizado
        $wp_customize->add_setting( 'woocommerce_custom_checkout', array(
            'default'           => true,
            'sanitize_callback' => 'novaui_sanitize_checkbox',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( 'woocommerce_custom_checkout', array(
            'label'       => __( 'Use Custom Checkout', 'novaui' ),
            'description' => __( 'Enable NovaUI custom checkout design', 'novaui' ),
            'section'     => 'novaui_woocommerce_options',
            'type'        => 'checkbox',
        ) );
    }
}
add_action( 'customize_register', 'novaui_customize_register' );

/**
 * Sanitiza un valor booleano (checkbox)
 *
 * @param bool $checked Estado del checkbox
 * @return bool Valor sanitizado
 */
function novaui_sanitize_checkbox( $checked ) {
    return isset( $checked ) && true === $checked;
}

/**
 * Sanitiza una opción de selección
 *
 * @param string $input Valor seleccionado
 * @param WP_Customize_Setting $setting Objeto de configuración
 * @return string Valor sanitizado
 */
function novaui_sanitize_select( $input, $setting ) {
    // Obtener la lista de opciones válidas de la configuración
    $choices = $setting->manager->get_control( $setting->id )->choices;
    
    // Devolver el valor por defecto si la entrada no es válida
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Generar CSS personalizado basado en la configuración del customizer
 */
function novaui_customizer_css() {
    // Iniciar buffer de salida
    ob_start();
    
    // Obtener color primario
    $primary_color = get_theme_mod( 'primary_color', '#FF6B6B' );
    $secondary_color = get_theme_mod( 'secondary_color', '#4ECDC4' );
    $accent_color = get_theme_mod( 'accent_color', '#FFE66D' );
    
    // Generar CSS personalizado
    ?>
    <style type="text/css">
        :root {
            --color-primary: <?php echo esc_attr( $primary_color ); ?>;
            --color-secondary: <?php echo esc_attr( $secondary_color ); ?>;
            --color-accent: <?php echo esc_attr( $accent_color ); ?>;
            
            /* Otras variables CSS personalizadas */
            <?php do_action( 'novaui_customizer_css_variables' ); ?>
        }
        
        /* Estilos personalizados adicionales */
        <?php do_action( 'novaui_customizer_css_styles' ); ?>
    </style>
    <?php
    
    // Imprimir CSS generado
    echo ob_get_clean();
}
add_action( 'wp_head', 'novaui_customizer_css' );

/**
 * Cargar controladores personalizados para el customizer
 */
function novaui_load_customizer_controls() {
    // Cargar clase base para controladores personalizados
    require_once NOVAUI_THEME_DIR . '/inc/customizer/controls/control-base.php';
    
    // Cargar controladores específicos
    require_once NOVAUI_THEME_DIR . '/inc/customizer/controls/color-palette.php';
    require_once NOVAUI_THEME_DIR . '/inc/customizer/controls/font-selector.php';
    require_once NOVAUI_THEME_DIR . '/inc/customizer/controls/spacing-control.php';
    require_once NOVAUI_THEME_DIR . '/inc/customizer/controls/toggle-switch.php';
    require_once NOVAUI_THEME_DIR . '/inc/customizer/controls/sortable-list.php';
}
add_action( 'after_setup_theme', 'novaui_load_customizer_controls' );

/**
 * Añadir JavaScript para controles de vista previa en vivo
 */
function novaui_customize_preview_js() {
    wp_enqueue_script(
        'novaui-customizer-preview',
        novaui_js_url( 'customizer-preview' ),
        array( 'customize-preview', 'jquery' ),
        NOVAUI_VERSION,
        true
    );
}
add_action( 'customize_preview_init', 'novaui_customize_preview_js' );

/**
 * Añadir JavaScript para controles personalizados
 */
function novaui_customize_controls_js() {
    wp_enqueue_script(
        'novaui-customizer-controls',
        novaui_js_url( 'customizer-controls' ),
        array( 'customize-controls', 'jquery' ),
        NOVAUI_VERSION,
        true
    );
    
    wp_enqueue_style(
        'novaui-customizer-styles',
        novaui_css_url( 'customizer' ),
        array(),
        NOVAUI_VERSION
    );
}
add_action( 'customize_controls_enqueue_scripts', 'novaui_customize_controls_js' );
