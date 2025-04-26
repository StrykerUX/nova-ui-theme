<?php
/**
 * Gestión de assets del tema NovaUI
 * Este archivo maneja la carga de scripts y estilos CSS.
 *
 * @package NovaUI
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Registra y carga scripts y estilos del tema
 */
function novaui_enqueue_assets() {
    // Registrar Pico CSS como framework base
    wp_register_style( 
        'pico-css', 
        'https://cdn.jsdelivr.net/npm/@picocss/pico@1.5.10/css/pico.min.css', 
        array(), 
        '1.5.10' 
    );
    
    // Registrar fuentes
    wp_register_style(
        'novaui-google-fonts',
        'https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&family=Roboto+Mono&display=swap',
        array(),
        NOVAUI_VERSION
    );
    
    // Registrar estilos principales
    wp_register_style(
        'novaui-variables',
        novaui_css_url( 'variables' ),
        array( 'pico-css' ),
        NOVAUI_VERSION
    );
    
    wp_register_style(
        'novaui-base',
        novaui_css_url( 'base' ),
        array( 'novaui-variables', 'novaui-google-fonts' ),
        NOVAUI_VERSION
    );
    
    wp_register_style(
        'novaui-components',
        novaui_css_url( 'components' ),
        array( 'novaui-base' ),
        NOVAUI_VERSION
    );
    
    wp_register_style(
        'novaui-templates',
        novaui_css_url( 'templates' ),
        array( 'novaui-components' ),
        NOVAUI_VERSION
    );
    
    wp_register_style(
        'novaui-woocommerce',
        novaui_css_url( 'woocommerce' ),
        array( 'novaui-components' ),
        NOVAUI_VERSION
    );
    
    wp_register_style(
        'novaui-dark-mode',
        novaui_css_url( 'dark-mode' ),
        array( 'novaui-base' ),
        NOVAUI_VERSION
    );
    
    // Registrar scripts
    wp_register_script(
        'novaui-navigation',
        novaui_js_url( 'navigation' ),
        array(),
        NOVAUI_VERSION,
        true
    );
    
    wp_register_script(
        'novaui-theme-settings',
        novaui_js_url( 'theme-settings' ),
        array( 'jquery' ),
        NOVAUI_VERSION,
        true
    );
    
    wp_register_script(
        'novaui-dark-mode',
        novaui_js_url( 'dark-mode' ),
        array( 'jquery' ),
        NOVAUI_VERSION,
        true
    );
    
    // Cargar estilos y scripts registrados
    wp_enqueue_style( 'novaui-variables' );
    wp_enqueue_style( 'novaui-base' );
    wp_enqueue_style( 'novaui-components' );
    wp_enqueue_style( 'novaui-templates' );
    wp_enqueue_style( 'novaui-dark-mode' );
    
    // Cargar WooCommerce solo si está activo
    if ( class_exists( 'WooCommerce' ) && novaui_is_woocommerce_page() ) {
        wp_enqueue_style( 'novaui-woocommerce' );
    }
    
    // Cargar scripts
    wp_enqueue_script( 'novaui-navigation' );
    wp_enqueue_script( 'novaui-theme-settings' );
    wp_enqueue_script( 'novaui-dark-mode' );
    
    // Añadir variables a Javascript
    wp_localize_script( 'novaui-theme-settings', 'novaUISettings', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'themeUri' => NOVAUI_THEME_URI,
        'homeUrl' => home_url(),
        'isLoggedIn' => is_user_logged_in(),
        'isDashboard' => novaui_is_dashboard(),
        'darkMode' => array(
            'enabled' => novaui_is_dark_mode(),
            'toggleSelector' => '.theme-mode-toggle',
            'storageKey' => 'theme_mode',
        ),
    ));
    
    // Cargar soporte para comentarios si es necesario
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'novaui_enqueue_assets' );

/**
 * Cargar estilos y scripts para el editor de Gutenberg
 */
function novaui_enqueue_block_editor_assets() {
    // Estilos para el editor
    wp_enqueue_style(
        'novaui-editor-styles',
        novaui_css_url( 'editor' ),
        array(),
        NOVAUI_VERSION
    );
    
    // Fuentes para el editor
    wp_enqueue_style(
        'novaui-google-fonts',
        'https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&family=Roboto+Mono&display=swap',
        array(),
        NOVAUI_VERSION
    );
    
    // Scripts para el editor
    wp_enqueue_script(
        'novaui-editor-scripts',
        novaui_js_url( 'editor' ),
        array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
        NOVAUI_VERSION,
        true
    );
}
add_action( 'enqueue_block_editor_assets', 'novaui_enqueue_block_editor_assets' );

/**
 * Cargar estilos y scripts para el área de administración
 */
function novaui_enqueue_admin_assets() {
    // Estilos para la administración
    wp_enqueue_style(
        'novaui-admin-styles',
        novaui_css_url( 'admin' ),
        array(),
        NOVAUI_VERSION
    );
    
    // Scripts para la administración
    wp_enqueue_script(
        'novaui-admin-scripts',
        novaui_js_url( 'admin' ),
        array( 'jquery' ),
        NOVAUI_VERSION,
        true
    );
}
add_action( 'admin_enqueue_scripts', 'novaui_enqueue_admin_assets' );

/**
 * Añadir atributos async/defer a scripts específicos
 */
function novaui_script_loader_tag( $tag, $handle, $src ) {
    // Lista de scripts que deben cargarse de forma asíncrona
    $async_scripts = array( 'novaui-dark-mode' );
    
    // Lista de scripts que deben cargarse con defer
    $defer_scripts = array( 'novaui-navigation', 'novaui-theme-settings' );
    
    if ( in_array( $handle, $async_scripts ) ) {
        return str_replace( ' src', ' async src', $tag );
    }
    
    if ( in_array( $handle, $defer_scripts ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    
    return $tag;
}
add_filter( 'script_loader_tag', 'novaui_script_loader_tag', 10, 3 );

/**
 * Registrar el archivo de estilo principal (style.css)
 * Solo para mantener compatibilidad con temas secundarios
 */
function novaui_register_main_stylesheet() {
    wp_register_style(
        'novaui-style',
        get_stylesheet_uri(),
        array(),
        NOVAUI_VERSION
    );
    
    wp_enqueue_style( 'novaui-style' );
}
add_action( 'wp_enqueue_scripts', 'novaui_register_main_stylesheet', 99 );

/**
 * Optimización de assets para mejorar rendimiento
 */
function novaui_optimize_assets() {
    // Quitar versión de los assets (para mejorar caché)
    if ( ! is_admin() ) {
        add_filter( 'style_loader_src', 'novaui_remove_wp_version_strings' );
        add_filter( 'script_loader_src', 'novaui_remove_wp_version_strings' );
    }
    
    // Eliminar emoji script
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    
    // Eliminar el feed de WordPress
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    
    // Quitar el generador de versión de WordPress
    remove_action( 'wp_head', 'wp_generator' );
    
    // Quitar enlaces a posts (prev, next)
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
}
add_action( 'init', 'novaui_optimize_assets' );

/**
 * Quitar strings de versión de URLs
 */
function novaui_remove_wp_version_strings( $src ) {
    global $wp_version;
    
    // Quitar parámetro ver
    if ( strpos( $src, 'ver=' . $wp_version ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    
    return $src;
}

/**
 * Precargar fuentes para mejorar rendimiento
 */
function novaui_preload_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action( 'wp_head', 'novaui_preload_fonts', 1 );
