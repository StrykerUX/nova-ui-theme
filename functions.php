<?php
/**
 * Funciones y definiciones del tema NovaUI
 *
 * @package NovaUI
 */

if ( ! defined( 'NOVAUI_VERSION' ) ) {
    // Reemplaza el número de versión cada vez que hagas cambios significativos.
    define( 'NOVAUI_VERSION', '1.0.0' );
}

/**
 * Configuración del tema y registro de soporte de características
 */
function novaui_setup() {
    /*
     * Hacer que el tema esté disponible para traducción.
     */
    load_theme_textdomain( 'novaui', get_template_directory() . '/languages' );

    // Añadir soporte para título de página autogenerado.
    add_theme_support( 'title-tag' );

    // Habilitar soporte para Post Thumbnails en posts y páginas.
    add_theme_support( 'post-thumbnails' );

    // Registrar menús de navegación
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Primary', 'novaui' ),
            'menu-2' => esc_html__( 'Footer', 'novaui' ),
            'menu-3' => esc_html__( 'Dashboard', 'novaui' ),
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

    // Añadir soporte para WooCommerce
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'novaui_setup' );

/**
 * Registrar widget area.
 */
function novaui_widgets_init() {
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

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 1', 'novaui' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Add footer widgets here.', 'novaui' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 2', 'novaui' ),
            'id'            => 'footer-2',
            'description'   => esc_html__( 'Add footer widgets here.', 'novaui' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 3', 'novaui' ),
            'id'            => 'footer-3',
            'description'   => esc_html__( 'Add footer widgets here.', 'novaui' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

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
}
add_action( 'widgets_init', 'novaui_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function novaui_scripts() {
    // Pico CSS (base framework)
    wp_enqueue_style( 'pico-css', 'https://cdn.jsdelivr.net/npm/@picocss/pico@1.5.10/css/pico.min.css', array(), '1.5.10' );
    
    // Enqueue main stylesheet
    wp_enqueue_style( 'novaui-style', get_stylesheet_uri(), array(), NOVAUI_VERSION );
    
    // Enqueue custom styles
    wp_enqueue_style( 'novaui-main', get_template_directory_uri() . '/assets/css/main.css', array('pico-css'), NOVAUI_VERSION );
    
    // Enqueue theme dark mode
    wp_enqueue_style( 'novaui-dark-mode', get_template_directory_uri() . '/assets/css/dark-mode.css', array('novaui-main'), NOVAUI_VERSION );
    
    // Enqueue scripts
    wp_enqueue_script( 'novaui-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), NOVAUI_VERSION, true );
    
    // Theme settings
    wp_enqueue_script( 'novaui-theme-settings', get_template_directory_uri() . '/assets/js/theme-settings.js', array('jquery'), NOVAUI_VERSION, true );
    
    // Dark mode script
    wp_enqueue_script( 'novaui-dark-mode', get_template_directory_uri() . '/assets/js/dark-mode.js', array('jquery'), NOVAUI_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'novaui_scripts' );

/**
 * Registrar templates personalizadas
 */
function novaui_register_template_pages() {
    // Template para Dashboard
    $dashboard_template = array(
        'page-templates/dashboard.php' => __('Dashboard', 'novaui'),
    );
    add_filter('theme_page_templates', function($post_templates) use ($dashboard_template) {
        return array_merge($post_templates, $dashboard_template);
    });
    
    // Template para Canvas
    $canvas_template = array(
        'page-templates/canvas.php' => __('Canvas', 'novaui'),
    );
    add_filter('theme_page_templates', function($post_templates) use ($canvas_template) {
        return array_merge($post_templates, $canvas_template);
    });
    
    // Template Full (con sidebar)
    $full_template = array(
        'page-templates/full.php' => __('Full', 'novaui'),
    );
    add_filter('theme_page_templates', function($post_templates) use ($full_template) {
        return array_merge($post_templates, $full_template);
    });
    
    // Template Sin Sidebar
    $sin_sidebar_template = array(
        'page-templates/sin-sidebar.php' => __('Sin Sidebar', 'novaui'),
    );
    add_filter('theme_page_templates', function($post_templates) use ($sin_sidebar_template) {
        return array_merge($post_templates, $sin_sidebar_template);
    });
}
add_action('init', 'novaui_register_template_pages', 99);

/**
 * Incluye los archivos adicionales del tema
 */

// Personalización del tema
require get_template_directory() . '/inc/customizer.php';

// Funciones de template
require get_template_directory() . '/inc/template-functions.php';

// Tags de template
require get_template_directory() . '/inc/template-tags.php';

// Funciones para WooCommerce
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}

// Shortcodes
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Añadir clases al body
 */
function novaui_body_classes( $classes ) {
    // Añade una clase si el tema oscuro está activado
    if ( isset( $_COOKIE['theme_mode'] ) && $_COOKIE['theme_mode'] === 'dark' ) {
        $classes[] = 'dark-mode';
    } else {
        $classes[] = 'light-mode';
    }

    // Añade una clase si es dashboard
    if ( is_page_template( 'page-templates/dashboard.php' ) ) {
        $classes[] = 'dashboard-layout';
    }

    // Añade una clase si es sin sidebar
    if ( is_page_template( 'page-templates/sin-sidebar.php' ) ) {
        $classes[] = 'no-sidebar';
    }

    // Añade una clase si es canvas
    if ( is_page_template( 'page-templates/canvas.php' ) ) {
        $classes[] = 'canvas-layout';
    }

    return $classes;
}
add_filter( 'body_class', 'novaui_body_classes' );
