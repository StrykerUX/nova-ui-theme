<?php
/**
 * Funciones y definiciones del tema NovaUI
 *
 * @package NovaUI
 */

if ( ! defined( 'NOVA_UI_VERSION' ) ) {
    // Reemplaza el número de versión de la línea siguiente cuando se lance una nueva versión
    define( 'NOVA_UI_VERSION', '0.1.0' );
}

/**
 * Configuración del tema
 */
function nova_ui_setup() {
    /*
     * Hacer que el tema esté disponible para traducción.
     * Las traducciones pueden colocarse en el directorio /languages/
     */
    load_theme_textdomain( 'nova-ui', get_template_directory() . '/languages' );

    // Añadir soporte para el título del sitio automático para SEO
    add_theme_support( 'title-tag' );

    // Activar miniaturas destacadas en posts y páginas
    add_theme_support( 'post-thumbnails' );

    // Registrar ubicaciones de menús
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Primary', 'nova-ui' ),
            'menu-sidebar' => esc_html__( 'Sidebar Menu', 'nova-ui' ),
            'menu-footer' => esc_html__( 'Footer Menu', 'nova-ui' ),
        )
    );

    /*
     * Soporte para HTML5 para formularios, galerías, etc.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Soporte para logo personalizado
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    // Soporte para editor de bloques
    add_theme_support( 'align-wide' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'nova_ui_setup' );

/**
 * Registrar áreas de widgets
 */
function nova_ui_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'nova-ui' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'nova-ui' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 1', 'nova-ui' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Add footer widgets here.', 'nova-ui' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 2', 'nova-ui' ),
            'id'            => 'footer-2',
            'description'   => esc_html__( 'Add footer widgets here.', 'nova-ui' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 3', 'nova-ui' ),
            'id'            => 'footer-3',
            'description'   => esc_html__( 'Add footer widgets here.', 'nova-ui' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'nova_ui_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nova_ui_scripts() {
    // Estilos de tema
    wp_enqueue_style( 'nova-ui-style', get_stylesheet_uri(), array(), NOVA_UI_VERSION );
    wp_enqueue_style( 'nova-ui-main', get_template_directory_uri() . '/assets/css/main.css', array(), NOVA_UI_VERSION );
    
    // Scripts
    wp_enqueue_script( 'nova-ui-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), NOVA_UI_VERSION, true );
    wp_enqueue_script( 'nova-ui-dark-mode', get_template_directory_uri() . '/assets/js/dark-mode.js', array(), NOVA_UI_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'nova_ui_scripts' );

/**
 * Incluir archivos adicionales
 */

// Custom template tags para este tema
require get_template_directory() . '/inc/template-tags.php';

// Funciones que mejoran el tema añadiendo características personalizadas
require get_template_directory() . '/inc/template-functions.php';

// Funciones de personalización dentro del personalizador de WordPress
require get_template_directory() . '/inc/customizer/customizer.php';

// Implementación de shortcodes del tema
require get_template_directory() . '/inc/shortcodes/shortcodes.php';

// Integraciones con WooCommerce (si está activo)
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce/woocommerce.php';
}
