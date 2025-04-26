<?php
/**
 * Funciones que mejoran el tema al añadir funcionalidad personalizada
 *
 * @package NovaUI
 */

/**
 * Agrega clases al body_class para estilizar mejor
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function nova_ui_body_classes( $classes ) {
    // Agregar clase basada en el tema claro/oscuro (por defecto es tema claro)
    $classes[] = 'light-mode';
    
    // Agregar una clase para cuando no hay barra lateral
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }
    
    // Determinar si es la página frontal o blog
    if ( is_front_page() && is_home() ) {
        $classes[] = 'home-blog';
    } elseif ( is_front_page() ) {
        $classes[] = 'home';
    } elseif ( is_home() ) {
        $classes[] = 'blog';
    }
    
    // Determinar si estamos en una plantilla de dashboard
    if ( is_page_template( 'templates/dashboard.php' ) ) {
        $classes[] = 'dashboard-page';
    }
    
    // Añadir clase de layout sin sidebar si estamos usando esa plantilla
    if ( is_page_template( 'templates/sin-sidebar.php' ) ) {
        $classes[] = 'no-sidebar-template';
    }
    
    // Añadir clase de canvas (página en blanco) si estamos usando esa plantilla
    if ( is_page_template( 'templates/canvas.php' ) ) {
        $classes[] = 'canvas-template';
    }
    
    // Verificar si WooCommerce está activo
    if ( class_exists( 'WooCommerce' ) ) {
        $classes[] = 'woocommerce-active';
        
        // Añadir clases específicas para páginas de WooCommerce
        if ( is_woocommerce() ) {
            $classes[] = 'woocommerce-page';
        }
        
        if ( is_cart() ) {
            $classes[] = 'woocommerce-cart';
        }
        
        if ( is_checkout() ) {
            $classes[] = 'woocommerce-checkout';
        }
        
        if ( is_account_page() ) {
            $classes[] = 'woocommerce-account';
        }
    }
    
    return $classes;
}
add_filter( 'body_class', 'nova_ui_body_classes' );

/**
 * Agrega una etiqueta meta de verificación del modo color preferido
 */
function nova_ui_add_meta_theme_color() {
    echo '<meta name="theme-color" content="#FF6B6B">';
    echo '<meta name="color-scheme" content="light dark">';
}
add_action( 'wp_head', 'nova_ui_add_meta_theme_color' );

/**
 * Agrega soporte para atributos async y defer a los scripts
 */
function nova_ui_script_loader_tag( $tag, $handle, $src ) {
    // Los handles de los scripts que deben cargar con async/defer
    $async_scripts = array( 'nova-ui-dark-mode' );
    $defer_scripts = array( 'nova-ui-navigation' );
    
    // Agregar atributo async
    if ( in_array( $handle, $async_scripts ) ) {
        $tag = str_replace( ' src', ' async src', $tag );
    }
    
    // Agregar atributo defer
    if ( in_array( $handle, $defer_scripts ) ) {
        $tag = str_replace( ' src', ' defer src', $tag );
    }
    
    return $tag;
}
add_filter( 'script_loader_tag', 'nova_ui_script_loader_tag', 10, 3 );

/**
 * Agrega clases personalizadas a los menús
 */
function nova_ui_menu_classes( $classes, $item, $args ) {
    // Agregar clase para elementos con submenús
    if ( in_array( 'menu-item-has-children', $classes ) ) {
        $classes[] = 'saas-dropdown';
    }
    
    // Agregar clases específicas según el menú
    if ( isset( $args->theme_location ) ) {
        $classes[] = 'saas-menu-item--' . $args->theme_location;
    }
    
    return $classes;
}
add_filter( 'nav_menu_css_class', 'nova_ui_menu_classes', 10, 3 );

/**
 * Función de ayuda para verificar si estamos en una página de dashboard
 */
function nova_ui_is_dashboard() {
    return is_page_template( 'templates/dashboard.php' ) ||
           ( function_exists( 'is_account_page' ) && is_account_page() ) ||
           apply_filters( 'nova_ui_is_dashboard', false );
}

/**
 * Personalizar el título del extracto de los posts
 */
function nova_ui_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'nova_ui_excerpt_more' );

/**
 * Personalizar la longitud del extracto
 */
function nova_ui_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'nova_ui_excerpt_length' );

/**
 * Personalizar el link de edición de post
 */
function nova_ui_edit_post_link( $id = 0 ) {
    if ( ! $id ) {
        $id = get_the_ID();
    }
    
    edit_post_link(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Edit<span class="screen-reader-text">%s</span>', 'nova-ui' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            wp_kses_post( get_the_title($id) )
        ),
        '<span class="edit-link">',
        '</span>',
        $id
    );
}

/**
 * Agregar clases personalizadas a los widgets
 */
function nova_ui_widget_classes( $params ) {
    $params[0]['before_widget'] = str_replace( 'class="', 'class="saas-widget ', $params[0]['before_widget'] );
    return $params;
}
add_filter( 'dynamic_sidebar_params', 'nova_ui_widget_classes' );

/**
 * Soporte para SVG en cargas de archivos
 */
function nova_ui_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'nova_ui_mime_types' );

/**
 * Obtener URL del ícono según el formato de post
 */
function nova_ui_get_post_format_icon() {
    $format = get_post_format();
    $icon = 'file-text'; // Por defecto
    
    switch ( $format ) {
        case 'video':
            $icon = 'video';
            break;
        case 'audio':
            $icon = 'music';
            break;
        case 'image':
            $icon = 'image';
            break;
        case 'gallery':
            $icon = 'grid';
            break;
        case 'quote':
            $icon = 'message-square';
            break;
        case 'link':
            $icon = 'link';
            break;
        case 'status':
            $icon = 'message-circle';
            break;
        case 'chat':
            $icon = 'message-circle';
            break;
        case 'aside':
            $icon = 'file-text';
            break;
    }
    
    return $icon;
}

/**
 * Agregar soporte para la opción "Abrir en nueva pestaña" en el menú
 */
function nova_ui_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
    if ( isset( $item->target ) && $item->target === '_blank' ) {
        $atts['rel'] = 'noopener noreferrer';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'nova_ui_nav_menu_link_attributes', 10, 4 );

/**
 * Detectar si estamos en una página con barra lateral colapsada
 */
function nova_ui_is_sidebar_collapsed() {
    return isset( $_COOKIE['novaui-sidebar-state'] ) && $_COOKIE['novaui-sidebar-state'] === 'collapsed';
}

/**
 * Generar clases para entradas de menú activas
 */
function nova_ui_menu_item_classes( $classes, $item ) {
    if ( in_array( 'current-menu-item', $classes ) || in_array( 'current-page-ancestor', $classes ) ) {
        $classes[] = 'saas-active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'nova_ui_menu_item_classes', 10, 2 );
