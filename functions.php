<?php
/**
 * Funciones principales del tema NovaUI
 *
 * @package NovaUI
 */

if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente
}

/**
 * Definir constantes del tema
 */
define('NOVAUI_VERSION', '1.0.0');
define('NOVAUI_DIR', get_template_directory());
define('NOVAUI_URI', get_template_directory_uri());
define('NOVAUI_ASSETS', NOVAUI_URI . '/assets');
define('NOVAUI_CSS', NOVAUI_ASSETS . '/css');
define('NOVAUI_JS', NOVAUI_ASSETS . '/js');
define('NOVAUI_IMAGES', NOVAUI_ASSETS . '/images');
define('NOVAUI_FONTS', NOVAUI_ASSETS . '/fonts');

/**
 * Configuración del tema
 */
function novaui_setup() {
    // Añadir soporte para el título del sitio
    add_theme_support('title-tag');
    
    // Habilitar soporte para Post Thumbnails (imágenes destacadas)
    add_theme_support('post-thumbnails');
    
    // Habilitar soporte HTML5 para formularios de búsqueda, comentarios, etc.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Añadir soporte para el modo oscuro
    add_theme_support('dark-editor-style');
    
    // Registrar menús de navegación
    register_nav_menus(array(
        'primary' => esc_html__('Menú Principal', 'novaui'),
        'dashboard-sidebar' => esc_html__('Menú Dashboard', 'novaui'),
        'footer' => esc_html__('Menú Footer', 'novaui'),
    ));
    
    // Añadir soporte para tipos de post personalizados
    add_theme_support('custom-post-types');
    
    // Añadir soporte para estilos del editor
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    
    // Añadir soporte para WooCommerce (si está activado)
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'novaui_setup');

/**
 * Registrar y cargar estilos y scripts
 */
function novaui_scripts() {
    // Registrar PicoCSS como base
    wp_register_style(
        'picocss', 
        'https://cdn.jsdelivr.net/npm/@picocss/pico@1.5.9/css/pico.min.css', 
        array(), 
        '1.5.9'
    );
    
    // Estilos principales
    wp_enqueue_style(
        'novaui-main', 
        NOVAUI_CSS . '/main.css',
        array('picocss'), 
        NOVAUI_VERSION
    );
    
    // Estilos específicos según la plantilla
    if (is_page_template('templates/dashboard.php')) {
        wp_enqueue_style(
            'novaui-dashboard', 
            NOVAUI_CSS . '/templates/dashboard.css',
            array('novaui-main'), 
            NOVAUI_VERSION
        );
    }
    
    // Registrar Font Awesome para iconos
    wp_register_style(
        'font-awesome', 
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css',
        array(), 
        '6.2.0'
    );
    
    // Cargar Font Awesome solo donde se necesite
    if (is_page_template(array(
        'templates/dashboard.php',
        'templates/chat-ai.php',
        'templates/quick-links.php'
    ))) {
        wp_enqueue_style('font-awesome');
    }
    
    // Script para el cambio de tema claro/oscuro
    wp_enqueue_script(
        'novaui-theme-switcher',
        NOVAUI_JS . '/theme-switcher.js',
        array(), 
        NOVAUI_VERSION,
        true
    );
    
    // Scripts específicos para dashboard
    if (is_page_template('templates/dashboard.php')) {
        wp_enqueue_script(
            'novaui-dashboard',
            NOVAUI_JS . '/components/dashboard.js',
            array('jquery'), 
            NOVAUI_VERSION,
            true
        );
    }
    
    // Scripts para la funcionalidad del sidebar
    wp_enqueue_script(
        'novaui-sidebar',
        NOVAUI_JS . '/components/sidebar.js',
        array('jquery'), 
        NOVAUI_VERSION,
        true
    );
    
    // Script principal (último para que pueda usar dependencias anteriores)
    wp_enqueue_script(
        'novaui-main',
        NOVAUI_JS . '/main.js',
        array('jquery'), 
        NOVAUI_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'novaui_scripts');

/**
 * Registrar widgets y sidebars
 */
function novaui_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar Principal', 'novaui'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Añade widgets aquí.', 'novaui'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Dashboard Sidebar', 'novaui'),
        'id'            => 'dashboard-sidebar',
        'description'   => esc_html__('Añade widgets para el sidebar del dashboard.', 'novaui'),
        'before_widget' => '<div id="%1$s" class="dashboard-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="dashboard-widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Widgets', 'novaui'),
        'id'            => 'footer-widgets',
        'description'   => esc_html__('Añade widgets para el footer.', 'novaui'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'novaui_widgets_init');

/**
 * Cargar archivos adicionales
 */
$novaui_includes = array(
    '/inc/template-tags.php',          // Tags de plantilla personalizados
    '/inc/template-functions.php',     // Funciones para modificar las plantillas
    '/inc/customizer.php',             // Funciones del personalizador de temas
    '/inc/enqueue-scripts.php',        // Funciones para registrar scripts y estilos adicionales
);

foreach ($novaui_includes as $file) {
    if (file_exists(NOVAUI_DIR . $file)) {
        require_once NOVAUI_DIR . $file;
    }
}

/**
 * Función para determinar si el modo oscuro está activo
 */
function novaui_is_dark_mode() {
    $default_mode = get_theme_mod('novaui_default_theme_mode', 'auto');
    
    // Si el modo está configurado como "auto", determinar basado en las preferencias del usuario
    if ($default_mode === 'auto') {
        return isset($_COOKIE['novaui_dark_mode']) && $_COOKIE['novaui_dark_mode'] === 'true';
    }
    
    // Si no, usar la configuración del tema
    return $default_mode === 'dark';
}

/**
 * Función para obtener la clase CSS para el tema oscuro/claro
 */
function novaui_theme_mode_class() {
    return novaui_is_dark_mode() ? 'dark-mode' : 'light-mode';
}

/**
 * Registrar tipos de posts personalizados para Quick Links
 */
function novaui_register_post_types() {
    // Tipo de post personalizado para Quick Links
    register_post_type('quick_link', array(
        'labels' => array(
            'name' => __('Quick Links', 'novaui'),
            'singular_name' => __('Quick Link', 'novaui'),
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-admin-links',
        'rewrite' => array('slug' => 'quick-links'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'novaui_register_post_types');

/**
 * Agregar clases al body para el tema
 */
function novaui_body_classes($classes) {
    // Agregar clase para modo oscuro/claro
    $classes[] = novaui_theme_mode_class();
    
    // Agregar clase si estamos en el dashboard
    if (is_page_template('templates/dashboard.php')) {
        $classes[] = 'nova-dashboard';
    }
    
    return $classes;
}
add_filter('body_class', 'novaui_body_classes');
