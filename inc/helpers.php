<?php
/**
 * Funciones auxiliares para el tema NovaUI
 * Este archivo contiene funciones de utilidad que pueden ser usadas en toda la aplicación.
 *
 * @package NovaUI
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Obtener URL de un asset
 *
 * @param string $path Ruta del asset relativa a la carpeta assets
 * @return string URL completa del asset
 */
function novaui_asset_url( $path = '' ) {
    return NOVAUI_ASSETS_URI . '/' . ltrim( $path, '/' );
}

/**
 * Obtener URL de un archivo CSS
 *
 * @param string $filename Nombre del archivo CSS sin la extensión
 * @return string URL completa del archivo CSS
 */
function novaui_css_url( $filename = '' ) {
    return NOVAUI_CSS_URI . '/' . $filename . '.css';
}

/**
 * Obtener URL de un archivo JS
 *
 * @param string $filename Nombre del archivo JS sin la extensión
 * @return string URL completa del archivo JS
 */
function novaui_js_url( $filename = '' ) {
    return NOVAUI_JS_URI . '/' . $filename . '.js';
}

/**
 * Obtener URL de una imagen
 *
 * @param string $filename Nombre del archivo de imagen con extensión
 * @return string URL completa de la imagen
 */
function novaui_image_url( $filename = '' ) {
    return NOVAUI_IMAGES_URI . '/' . $filename;
}

/**
 * Comprobar si el tema oscuro está activado
 *
 * @return boolean Verdadero si el tema oscuro está activado
 */
function novaui_is_dark_mode() {
    // Primero verificar cookie/localStorage
    if ( isset( $_COOKIE['theme_mode'] ) && $_COOKIE['theme_mode'] === 'dark' ) {
        return true;
    }
    
    // Verificar configuración de WordPress si no hay preferencia de usuario
    return get_theme_mod( 'default_dark_mode', false );
}

/**
 * Verificar si la página actual es un dashboard
 *
 * @return boolean Verdadero si es una página de dashboard
 */
function novaui_is_dashboard() {
    return is_page_template( 'page-templates/dashboard.php' );
}

/**
 * Añadir clases condicionales al elemento <body>
 *
 * @param array $classes Clases existentes para el elemento body
 * @return array Clases actualizadas para el elemento body
 */
function novaui_body_classes( $classes ) {
    // Añade una clase según el modo de tema (oscuro/claro)
    if ( novaui_is_dark_mode() ) {
        $classes[] = 'dark-mode';
    } else {
        $classes[] = 'light-mode';
    }

    // Añade una clase si es dashboard
    if ( novaui_is_dashboard() ) {
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
    
    // Añade una clase si es página de membresía
    if ( class_exists( 'WC_Memberships' ) && wc_memberships_is_user_active_member() ) {
        $classes[] = 'is-member';
        
        // Añadir clases específicas por plan
        $user_id = get_current_user_id();
        if ( $user_id ) {
            $active_memberships = wc_memberships_get_user_active_memberships( $user_id );
            foreach ( $active_memberships as $membership ) {
                $plan_slug = sanitize_html_class( $membership->get_plan()->get_slug() );
                $classes[] = 'has-membership-' . $plan_slug;
            }
        }
    }

    return $classes;
}
add_filter( 'body_class', 'novaui_body_classes' );

/**
 * Obtener ícono SVG inline
 *
 * @param string $icon Nombre del icono (sin la extensión .svg)
 * @param array $args Argumentos adicionales (class, width, height, etc.)
 * @return string Código SVG inline o mensaje de error
 */
function novaui_get_icon( $icon, $args = array() ) {
    // Definir argumentos por defecto
    $defaults = array(
        'class'   => '',
        'width'   => 24,
        'height'  => 24,
        'aria-hidden' => 'true',
        'role'    => 'img',
        'focusable' => 'false',
    );
    
    // Combinar argumentos
    $args = wp_parse_args( $args, $defaults );
    
    // Obtener ruta del icono
    $icon_path = NOVAUI_THEME_DIR . '/assets/icons/' . $icon . '.svg';
    
    // Verificar si el archivo existe
    if ( ! file_exists( $icon_path ) ) {
        return sprintf( '<span class="novaui-icon-error">%s</span>', esc_html__( 'Icon not found', 'novaui' ) );
    }
    
    // Obtener el contenido del SVG
    $svg_content = file_get_contents( $icon_path );
    
    // Si el SVG está vacío, mostrar error
    if ( empty( $svg_content ) ) {
        return sprintf( '<span class="novaui-icon-error">%s</span>', esc_html__( 'Icon is empty', 'novaui' ) );
    }
    
    // Extraer el contenido entre las etiquetas svg
    preg_match( '/<svg.*?>(.*?)<\/svg>/s', $svg_content, $matches );
    
    if ( empty( $matches[1] ) ) {
        return sprintf( '<span class="novaui-icon-error">%s</span>', esc_html__( 'Invalid SVG format', 'novaui' ) );
    }
    
    $inner_content = $matches[1];
    
    // Crear atributos para la etiqueta SVG
    $attributes = '';
    foreach ( $args as $key => $value ) {
        if ( ! empty( $value ) ) {
            $attributes .= ' ' . $key . '="' . esc_attr( $value ) . '"';
        }
    }
    
    // Construir etiqueta SVG
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"' . $attributes . '>' . $inner_content . '</svg>';
    
    return $svg;
}

/**
 * Mostrar ícono SVG
 *
 * @param string $icon Nombre del icono (sin la extensión .svg)
 * @param array $args Argumentos adicionales (class, width, height, etc.)
 */
function novaui_icon( $icon, $args = array() ) {
    echo novaui_get_icon( $icon, $args );
}

/**
 * Detectar si es una página de WooCommerce
 *
 * @return boolean Verdadero si es una página de WooCommerce
 */
function novaui_is_woocommerce_page() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return false;
    }
    
    return ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() );
}

/**
 * Añadir soporte para atributos srcset en logos personalizados
 *
 * @param string $html HTML del logo personalizado
 * @param int $site_logo_id ID del attachment del logo
 * @return string HTML modificado con srcset
 */
function novaui_filter_logo_html( $html, $site_logo_id ) {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    
    // Solo procesar si hay un logo personalizado
    if ( $custom_logo_id ) {
        $attr = array(
            'class'    => 'custom-logo',
            'itemprop' => 'logo',
        );
        
        // Cambiar a srcset para soporte responsive
        $html = wp_get_attachment_image( $custom_logo_id, 'full', false, $attr );
    }
    
    return $html;
}
add_filter( 'get_custom_logo', 'novaui_filter_logo_html', 10, 2 );

/**
 * Generar clases CSS basadas en el plan de membresía del usuario
 *
 * @return string Clases CSS para el plan de membresía
 */
function novaui_get_membership_classes() {
    $classes = array();
    
    if ( ! class_exists( 'WC_Memberships' ) ) {
        return implode( ' ', $classes );
    }
    
    $user_id = get_current_user_id();
    
    if ( ! $user_id ) {
        $classes[] = 'no-membership';
        return implode( ' ', $classes );
    }
    
    if ( wc_memberships_is_user_active_member( $user_id ) ) {
        $classes[] = 'has-membership';
        
        $active_memberships = wc_memberships_get_user_active_memberships( $user_id );
        
        foreach ( $active_memberships as $membership ) {
            $plan_slug = sanitize_html_class( $membership->get_plan()->get_slug() );
            $classes[] = 'plan-' . $plan_slug;
        }
    } else {
        $classes[] = 'no-membership';
    }
    
    return implode( ' ', $classes );
}
