<?php
/**
 * Nova UI - Funciones principales del tema
 *
 * @package Nova_UI
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes del tema
define('NOVA_UI_VERSION', '1.0.0');
define('NOVA_UI_DIR', get_template_directory());
define('NOVA_UI_URI', get_template_directory_uri());

/**
 * Configuración principal del tema
 */
function nova_ui_setup() {
    // Añadir soporte para título del sitio y etiqueta
    add_theme_support('title-tag');
    
    // Añadir soporte para miniaturas destacadas
    add_theme_support('post-thumbnails');
    
    // Añadir soporte para HTML5 en formularios, comentarios, etc.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Añadir soporte para logo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 48,
        'width'       => 48,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    
    // Registrar menús de navegación
    register_nav_menus(array(
        'sidebar' => esc_html__('Menú Lateral', 'nova-ui'),
        'topbar'  => esc_html__('Menú Superior', 'nova-ui'),
    ));
}
add_action('after_setup_theme', 'nova_ui_setup');

/**
 * Registrar y cargar scripts y estilos del tema
 */
function nova_ui_enqueue_scripts() {
    // Cargar estilos principales
    wp_enqueue_style(
        'nova-ui-main-style',
        NOVA_UI_URI . '/assets/css/main.css',
        array(),
        NOVA_UI_VERSION
    );
    
    // Cargar Tabler Icons para iconos
    wp_enqueue_style(
        'tabler-icons',
        'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css',
        array(),
        '2.30.0'
    );
    
    // Cargar scripts principales
    wp_enqueue_script(
        'nova-ui-main-script',
        NOVA_UI_URI . '/assets/js/main.js',
        array('jquery'),
        NOVA_UI_VERSION,
        true
    );
    
    // Pasar variables a JavaScript
    wp_localize_script('nova-ui-main-script', 'novaUIVars', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'themeUri' => NOVA_UI_URI,
    ));
}
add_action('wp_enqueue_scripts', 'nova_ui_enqueue_scripts');

/**
 * Función para detectar el modo oscuro
 * 
 * @return boolean
 */
function nova_ui_is_dark_mode() {
    // Por defecto usar preferencia del usuario guardada en cookie
    $is_dark = isset($_COOKIE['nova_ui_dark_mode']) ? $_COOKIE['nova_ui_dark_mode'] === 'true' : false;
    
    // Filtro para permitir personalizar la lógica
    return apply_filters('nova_ui_is_dark_mode', $is_dark);
}

/**
 * Función para obtener las iniciales del nombre
 * 
 * @param string $name Nombre completo
 * @return string Iniciales (máximo 2 caracteres)
 */
function nova_ui_get_initials($name) {
    $words = explode(' ', $name);
    $initials = '';
    
    if (count($words) >= 2) {
        $initials = mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1);
    } elseif (count($words) === 1) {
        $initials = mb_substr($words[0], 0, 2);
    }
    
    return mb_strtoupper($initials);
}

/**
 * Generar color basado en texto para avatares
 * 
 * @param string $text Texto para generar el color
 * @return string Color en formato hex
 */
function nova_ui_generate_color($text) {
    // Generar un hash simple basado en el texto
    $hash = md5($text);
    
    // Colores base para el diseño Neo Brutalismo Suave
    $colors = [
        '#FF6B6B', // Rosa/Rojo
        '#4ECDC4', // Turquesa
        '#FF8A5B', // Naranja/Coral
        '#F9DC5C', // Amarillo
        '#5BC0EB', // Azul claro
        '#9BC53D', // Verde
        '#E84855', // Rojo
        '#3185FC', // Azul
        '#EFBCD5', // Rosa claro
        '#0E79B2', // Azul oscuro
    ];
    
    // Seleccionar color basado en el hash
    $index = hexdec(substr($hash, 0, 8)) % count($colors);
    return $colors[$index];
}

/**
 * Función para renderizar el título de la página actual
 * 
 * @return void
 */
function nova_ui_page_title() {
    echo '<div class="page-title-container">';
    echo '<h1 class="page-title">' . get_the_title() . '</h1>';
    echo '</div>';
}

// Incluir archivos adicionales
require_once NOVA_UI_DIR . '/inc/template-functions.php';
require_once NOVA_UI_DIR . '/inc/template-tags.php';
require_once NOVA_UI_DIR . '/inc/class-nova-ui-walker-nav-menu.php';
