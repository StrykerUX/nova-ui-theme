<?php
/**
 * Funciones helper para el tema NovaUI
 *
 * @package NovaUI
 */

// No permitir el acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Obtener un icono SVG de Lucide Icons
 *
 * @param string $icon Nombre del icono (ejemplo: 'home', 'user', etc.)
 * @param string $size Tamaño del icono (xs, sm, md, lg, xl)
 * @param array  $attributes Atributos adicionales para el SVG
 * @return string HTML del icono SVG
 */
function nova_ui_get_svg_icon( $icon, $size = 'md', $attributes = array() ) {
    // Definir los tamaños disponibles
    $sizes = array(
        'xs' => 14,
        'sm' => 16,
        'md' => 20,
        'lg' => 24,
        'xl' => 30,
    );
    
    $pixel_size = isset( $sizes[ $size ] ) ? $sizes[ $size ] : $sizes['md'];
    
    // Atributos por defecto
    $default_attributes = array(
        'width' => $pixel_size,
        'height' => $pixel_size,
        'stroke' => 'currentColor',
        'stroke-width' => '2',
        'fill' => 'none',
        'stroke-linecap' => 'round',
        'stroke-linejoin' => 'round',
        'class' => 'nova-icon nova-icon-' . esc_attr( $icon ),
    );
    
    // Combinar atributos por defecto con los personalizados
    $attributes = array_merge( $default_attributes, $attributes );
    
    // Construir la cadena de atributos
    $attrs_string = '';
    foreach ( $attributes as $key => $value ) {
        $attrs_string .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
    }
    
    // Cargar la biblioteca de iconos
    $icons = nova_ui_get_svg_icons_library();
    
    // Verificar si el icono existe
    if ( ! isset( $icons[ $icon ] ) ) {
        return '<svg' . $attrs_string . '><path d="M10 10"></path></svg>';
    }
    
    // Devolver el SVG con el camino del icono
    return '<svg' . $attrs_string . '>' . $icons[ $icon ] . '</svg>';
}

/**
 * Biblioteca de iconos SVG basada en Lucide Icons
 *
 * @return array Array de iconos SVG
 */
function nova_ui_get_svg_icons_library() {
    return array(
        'home' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline>',
        'user' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>',
        'message-square' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>',
        'link' => '<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>',
        'log-out' => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line>',
        'menu' => '<line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>',
        'search' => '<circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>',
        'bell' => '<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path>',
        'moon' => '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>',
        'sun' => '<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>',
        'chevron-down' => '<polyline points="6 9 12 15 18 9"></polyline>',
        'settings' => '<circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>',
        'plus' => '<line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line>',
        'download' => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line>',
        'dollar-sign' => '<line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>',
        'users' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>',
        'activity' => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>',
        'send' => '<line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>',
        'clock' => '<circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>',
        'play' => '<polygon points="5 3 19 12 5 21 5 3"></polygon>',
        'heart' => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>',
        'help-circle' => '<circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line>',
        'credit-card' => '<rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line>',
        'gamepad-2' => '<path d="M15 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"></path><path d="M18 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"></path><path d="M17 17a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"></path><path d="M14 15a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"></path><rect width="20" height="12" x="2" y="6" rx="2"></rect><path d="M6 12h4"></path><path d="M8 10v4"></path>',
        'file-text' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>',
        'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>',
        'briefcase' => '<rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>',
        'bar-chart-2' => '<line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line>',
        'layout-grid' => '<rect width="7" height="7" x="3" y="3" rx="1"></rect><rect width="7" height="7" x="14" y="3" rx="1"></rect><rect width="7" height="7" x="14" y="14" rx="1"></rect><rect width="7" height="7" x="3" y="14" rx="1"></rect>',
        'alert-circle' => '<circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>',
    );
}

/**
 * Mostrar migas de pan / breadcrumbs en las páginas
 */
function nova_ui_breadcrumbs() {
    // No mostrar en la página de inicio
    if ( is_front_page() ) {
        return;
    }
    
    echo '<div class="breadcrumbs">';
    
    // Enlace a inicio
    echo '<span class="breadcrumbs-item">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'nova-ui' ) . '</a>';
    echo '</span>';
    
    echo '<span class="breadcrumbs-separator">/</span>';
    
    // Página actual
    if ( is_page() ) {
        // Si la página tiene una página padre
        $ancestors = get_post_ancestors( get_the_ID() );
        if ( $ancestors ) {
            $ancestors = array_reverse( $ancestors );
            foreach ( $ancestors as $ancestor ) {
                echo '<span class="breadcrumbs-item">';
                echo '<a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a>';
                echo '</span>';
                echo '<span class="breadcrumbs-separator">/</span>';
            }
        }
        
        echo '<span class="breadcrumbs-item active">' . esc_html( get_the_title() ) . '</span>';
    } elseif ( is_single() ) {
        // Entrada individual
        $categories = get_the_category();
        if ( $categories ) {
            $category = $categories[0];
            echo '<span class="breadcrumbs-item">';
            echo '<a href="' . esc_url( get_category_link( $category ) ) . '">' . esc_html( $category->name ) . '</a>';
            echo '</span>';
            echo '<span class="breadcrumbs-separator">/</span>';
        }
        
        echo '<span class="breadcrumbs-item active">' . esc_html( get_the_title() ) . '</span>';
    } elseif ( is_category() ) {
        // Página de categoría
        echo '<span class="breadcrumbs-item active">' . esc_html( single_cat_title( '', false ) ) . '</span>';
    } elseif ( is_search() ) {
        // Página de búsqueda
        echo '<span class="breadcrumbs-item active">' . esc_html__( 'Search Results', 'nova-ui' ) . '</span>';
    } elseif ( is_404() ) {
        // Página 404
        echo '<span class="breadcrumbs-item active">' . esc_html__( 'Page Not Found', 'nova-ui' ) . '</span>';
    }
    
    echo '</div>';
}

/**
 * Función para obtener el nombre de usuario abreviado
 * 
 * @param WP_User $user Usuario de WordPress
 * @return string Iniciales o primera letra del nombre
 */
function nova_ui_get_user_initials( $user ) {
    if ( ! $user || ! is_object( $user ) ) {
        return 'U';
    }
    
    $name = trim( $user->display_name );
    
    if ( empty( $name ) ) {
        $name = trim( $user->user_login );
    }
    
    if ( empty( $name ) ) {
        return 'U';
    }
    
    // Obtener iniciales de un nombre compuesto
    $words = explode( ' ', $name );
    if ( count( $words ) > 1 ) {
        return strtoupper( substr( $words[0], 0, 1 ) . substr( end( $words ), 0, 1 ) );
    } else {
        return strtoupper( substr( $name, 0, 1 ) );
    }
}

/**
 * Función para determinar si se debe activar el modo oscuro
 *
 * @return bool True si el modo oscuro está activado
 */
function nova_ui_is_dark_mode() {
    $dark_mode = isset( $_COOKIE['nova_ui_dark_mode'] ) ? $_COOKIE['nova_ui_dark_mode'] : 'auto';
    
    if ( $dark_mode === 'dark' ) {
        return true;
    } elseif ( $dark_mode === 'light' ) {
        return false;
    } else {
        // Si está en 'auto', dependerá de la preferencia del sistema
        // Pero no podemos detectarlo desde PHP, así que devolvemos false
        return false;
    }
}

/**
 * Añadir clases personalizadas al body
 *
 * @param array $classes Clases actuales del body
 * @return array Clases actualizadas
 */
function nova_ui_body_classes_custom( $classes ) {
    // Añadir clases específicas según la página
    if ( is_page_template( 'templates/dashboard.php' ) ) {
        $classes[] = 'template-dashboard';
        $classes[] = 'neo-brutalist';
    }
    
    if ( is_page_template( 'templates/canvas.php' ) ) {
        $classes[] = 'template-canvas';
    }
    
    if ( is_page_template( 'templates/full.php' ) ) {
        $classes[] = 'template-full';
    }
    
    // Añadir clase si es administrador
    if ( current_user_can( 'administrator' ) ) {
        $classes[] = 'is-admin';
    }
    
    return $classes;
}
add_filter( 'body_class', 'nova_ui_body_classes_custom' );
