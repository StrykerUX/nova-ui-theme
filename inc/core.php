<?php
/**
 * Funciones principales del tema NovaUI
 * Este archivo contiene las funciones fundamentales y configuraciones del tema.
 *
 * @package NovaUI
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Define constantes del tema
 */
function novaui_define_constants() {
    // Versión del tema
    if ( ! defined( 'NOVAUI_VERSION' ) ) {
        define( 'NOVAUI_VERSION', wp_get_theme()->get( 'Version' ) );
    }
    
    // Directorios del tema
    if ( ! defined( 'NOVAUI_THEME_DIR' ) ) {
        define( 'NOVAUI_THEME_DIR', get_template_directory() );
    }
    
    if ( ! defined( 'NOVAUI_THEME_URI' ) ) {
        define( 'NOVAUI_THEME_URI', get_template_directory_uri() );
    }
    
    // Assets
    if ( ! defined( 'NOVAUI_ASSETS_URI' ) ) {
        define( 'NOVAUI_ASSETS_URI', NOVAUI_THEME_URI . '/assets' );
    }
    
    // CSS
    if ( ! defined( 'NOVAUI_CSS_URI' ) ) {
        define( 'NOVAUI_CSS_URI', NOVAUI_ASSETS_URI . '/css' );
    }
    
    // JavaScript
    if ( ! defined( 'NOVAUI_JS_URI' ) ) {
        define( 'NOVAUI_JS_URI', NOVAUI_ASSETS_URI . '/js' );
    }
    
    // Fuentes
    if ( ! defined( 'NOVAUI_FONTS_URI' ) ) {
        define( 'NOVAUI_FONTS_URI', NOVAUI_ASSETS_URI . '/fonts' );
    }
    
    // Imágenes
    if ( ! defined( 'NOVAUI_IMAGES_URI' ) ) {
        define( 'NOVAUI_IMAGES_URI', NOVAUI_ASSETS_URI . '/images' );
    }
}
add_action( 'after_setup_theme', 'novaui_define_constants', 0 );

/**
 * Configuración del tema y registro de soporte de características
 */
function novaui_setup() {
    /*
     * Hacer que el tema esté disponible para traducción.
     */
    load_theme_textdomain( 'novaui', NOVAUI_THEME_DIR . '/languages' );

    // Añadir soporte para título de página autogenerado.
    add_theme_support( 'title-tag' );

    // Habilitar soporte para Post Thumbnails en posts y páginas.
    add_theme_support( 'post-thumbnails' );

    // Registrar menús de navegación
    register_nav_menus(
        array(
            'menu-primary'   => esc_html__( 'Primary Menu', 'novaui' ),
            'menu-footer'    => esc_html__( 'Footer Menu', 'novaui' ),
            'menu-dashboard' => esc_html__( 'Dashboard Menu', 'novaui' ),
            'menu-user'      => esc_html__( 'User Menu', 'novaui' ),
        )
    );

    /*
     * Cambiar el valor predeterminado tamaño de la imagen en la edición a ajustarse al contenedor.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Añadir soporte para el tema claro/oscuro
    add_theme_support( 'editor-color-palette' );
    add_theme_support( 'dark-editor-style' );

    // Añadir soporte para logo personalizado
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    // Añadir soporte para Custom Headers
    add_theme_support( 'custom-header' );

    // Añadir soporte para Custom Backgrounds
    add_theme_support( 'custom-background' );

    // Añadir soporte para Gutenberg
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    
    // Añadir soporte para WooCommerce
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'novaui_setup' );

/**
 * Registrar e incluir archivos del tema
 */
function novaui_includes() {
    // Funciones de utilidad
    require_once NOVAUI_THEME_DIR . '/inc/helpers.php';
    
    // Funciones de template
    require_once NOVAUI_THEME_DIR . '/inc/template-functions.php';
    
    // Tags de template
    require_once NOVAUI_THEME_DIR . '/inc/template-tags.php';
    
    // Personalización del tema
    require_once NOVAUI_THEME_DIR . '/inc/customizer/customizer.php';
    
    // Sistema de Shortcodes
    require_once NOVAUI_THEME_DIR . '/inc/shortcodes/shortcodes.php';
    
    // Sistema de assets
    require_once NOVAUI_THEME_DIR . '/inc/assets.php';
    
    // Integraciones
    require_once NOVAUI_THEME_DIR . '/inc/integrations/integrations.php';
    
    // Funciones para WooCommerce
    if ( class_exists( 'WooCommerce' ) ) {
        require_once NOVAUI_THEME_DIR . '/inc/woocommerce/woocommerce.php';
    }
}
add_action( 'after_setup_theme', 'novaui_includes' );

/**
 * Registrar widget areas
 */
function novaui_widgets_init() {
    // Sidebar Principal
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'novaui' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'novaui' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    // Áreas de Footer
    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar(
            array(
                'name'          => sprintf( esc_html__( 'Footer %d', 'novaui' ), $i ),
                'id'            => 'footer-' . $i,
                'description'   => esc_html__( 'Add footer widgets here.', 'novaui' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }

    // Dashboard Sidebar
    register_sidebar(
        array(
            'name'          => esc_html__( 'Dashboard Sidebar', 'novaui' ),
            'id'            => 'dashboard-sidebar',
            'description'   => esc_html__( 'Add dashboard widgets here.', 'novaui' ),
            'before_widget' => '<section id="%1$s" class="dashboard-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="dashboard-widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    // Widgets de Dashboard
    register_sidebar(
        array(
            'name'          => esc_html__( 'Dashboard Widgets', 'novaui' ),
            'id'            => 'dashboard-widgets',
            'description'   => esc_html__( 'Add widgets to the main dashboard area.', 'novaui' ),
            'before_widget' => '<div id="%1$s" class="dashboard-widget-container %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="dashboard-widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'novaui_widgets_init' );

/**
 * Registrar templates personalizadas
 */
function novaui_register_templates() {
    $templates = array(
        'page-templates/dashboard.php' => __( 'Dashboard', 'novaui' ),
        'page-templates/canvas.php'    => __( 'Canvas', 'novaui' ),
        'page-templates/full.php'      => __( 'Full (with sidebar)', 'novaui' ),
        'page-templates/sin-sidebar.php' => __( 'Sin Sidebar', 'novaui' ),
    );
    
    add_filter( 'theme_page_templates', function( $post_templates ) use ( $templates ) {
        return array_merge( $post_templates, $templates );
    });
}
add_action( 'init', 'novaui_register_templates', 20 );

/**
 * Añadir modo oscuro/claro
 */
function novaui_add_dark_mode_support() {
    // Configuración por defecto del tema oscuro/claro
    $default_mode = get_theme_mod( 'default_dark_mode', false ) ? 'dark' : 'light';
    
    // Script para gestionar el modo oscuro/claro
    $inline_script = "
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
        const storedTheme = localStorage.getItem('theme_mode');
        
        let theme = '" . $default_mode . "';
        
        if (storedTheme) {
            theme = storedTheme;
        } else if (prefersDarkScheme.matches) {
            theme = 'dark';
        }
        
        document.documentElement.setAttribute('data-theme', theme);
        document.body.classList.toggle('dark-mode', theme === 'dark');
        document.body.classList.toggle('light-mode', theme === 'light');
    ";
    
    wp_register_script( 'novaui-theme-mode', '', array(), NOVAUI_VERSION, false );
    wp_enqueue_script( 'novaui-theme-mode' );
    wp_add_inline_script( 'novaui-theme-mode', $inline_script );
}
add_action( 'wp_enqueue_scripts', 'novaui_add_dark_mode_support', 5 );
