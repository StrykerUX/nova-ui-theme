<?php
/**
 * Funciones que mejoran el tema al engancharse con WordPress
 *
 * @package Nova_UI
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Añadir clases al body
 * 
 * @param array $classes Clases existentes.
 * @return array Clases modificadas.
 */
function nova_ui_body_classes($classes) {
    // Añadir clase basada en el tema claro/oscuro
    if (nova_ui_is_dark_mode()) {
        $classes[] = 'dark-mode';
    } else {
        $classes[] = 'light-mode';
    }
    
    // Si es la página de inicio
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    
    // Si es una página de dashboard
    if (is_page_template('page-templates/dashboard.php')) {
        $classes[] = 'dashboard-page';
    }
    
    return $classes;
}
add_filter('body_class', 'nova_ui_body_classes');

/**
 * Añadir clase para enlace actual en menú
 * 
 * @param array $classes Clases del item.
 * @param object $item Objeto del item.
 * @param array $args Argumentos.
 * @return array Clases modificadas.
 */
function nova_ui_menu_item_classes($classes, $item, $args) {
    if (in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes)) {
        $classes[] = 'active';
    }
    
    return $classes;
}
add_filter('nav_menu_css_class', 'nova_ui_menu_item_classes', 10, 3);

/**
 * Personalizar el logo en el login de WordPress
 * 
 * @return string URL del logo.
 */
function nova_ui_login_logo() {
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/nova-ui-logo.png);
            height: 65px;
            width: 320px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'nova_ui_login_logo');

/**
 * Cambiar la URL del logo en el login
 * 
 * @return string URL del sitio.
 */
function nova_ui_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'nova_ui_login_logo_url');

/**
 * Cambiar el texto del logo en el login
 * 
 * @return string Nombre del sitio.
 */
function nova_ui_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'nova_ui_login_logo_url_title');

/**
 * Modificar excerpt para que termine con puntos suspensivos
 * 
 * @param string $more Texto por defecto.
 * @return string Texto modificado.
 */
function nova_ui_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'nova_ui_excerpt_more');

/**
 * Modificar longitud del excerpt
 * 
 * @param int $length Longitud por defecto.
 * @return int Longitud modificada.
 */
function nova_ui_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'nova_ui_excerpt_length');

/**
 * Añadir soporte para cargar scripts defer o async
 * 
 * @param string $tag Etiqueta script.
 * @param string $handle Identificador del script.
 * @return string Etiqueta modificada.
 */
function nova_ui_script_loader_tag($tag, $handle) {
    // Lista de scripts a cargar con defer
    $defer_scripts = array('nova-ui-main-script');
    
    // Lista de scripts a cargar con async
    $async_scripts = array();
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'nova_ui_script_loader_tag', 10, 2);

/**
 * Función para determinar la imagen destacada a usar
 * 
 * @param int $post_id ID del post.
 * @param string $size Tamaño de la imagen.
 * @return string URL de la imagen.
 */
function nova_ui_get_post_thumbnail($post_id = null, $size = 'medium') {
    if (null === $post_id) {
        $post_id = get_the_ID();
    }
    
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, $size);
    }
    
    // Si no hay imagen destacada, usar una imagen por defecto
    return NOVA_UI_URI . '/assets/images/placeholder.jpg';
}

/**
 * Convertir HEX a RGB
 * 
 * @param string $hex Color en formato hexadecimal.
 * @return array Array con valores RGB.
 */
function nova_ui_hex_to_rgb($hex) {
    $hex = str_replace('#', '', $hex);
    
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    
    return array($r, $g, $b);
}

/**
 * Ajustar brillo de un color
 * 
 * @param string $hex Color en formato hexadecimal.
 * @param int $steps Pasos a ajustar (positivo = más claro, negativo = más oscuro).
 * @return string Color ajustado en formato hexadecimal.
 */
function nova_ui_adjust_brightness($hex, $steps) {
    $steps = max(-255, min(255, $steps));
    
    $rgb = nova_ui_hex_to_rgb($hex);
    
    $r = max(0, min(255, $rgb[0] + $steps));
    $g = max(0, min(255, $rgb[1] + $steps));
    $b = max(0, min(255, $rgb[2] + $steps));
    
    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
    
    return '#' . $r_hex . $g_hex . $b_hex;
}
