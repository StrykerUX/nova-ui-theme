<?php
/**
 * Funciones adicionales para mejorar el tema
 *
 * @package NovaUI
 */

/**
 * Agrega clases al elemento <body>
 *
 * @param array $classes Clases para el elemento body.
 * @return array
 */
function novaui_body_classes( $classes ) {
    // Agrega una clase para indicar si hay sidebar
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    // Agrega una clase específica si es una página singular
    if ( is_singular() ) {
        $classes[] = 'singular';
    }

    // Agrega una clase si se está utilizando un template específico
    if ( is_page_template( 'page-templates/full.php' ) ) {
        $classes[] = 'template-full';
    } elseif ( is_page_template( 'page-templates/sin-sidebar.php' ) ) {
        $classes[] = 'template-sin-sidebar';
    } elseif ( is_page_template( 'page-templates/canvas.php' ) ) {
        $classes[] = 'template-canvas';
    } elseif ( is_page_template( 'page-templates/dashboard.php' ) ) {
        $classes[] = 'template-dashboard';
    }

    return $classes;
}
add_filter( 'body_class', 'novaui_body_classes' );

/**
 * Agrega la clase .img-fluid a todas las imágenes agregadas en el contenido
 *
 * @param string $content Contenido del post.
 * @return string
 */
function novaui_add_responsive_class_to_images( $content ) {
    if ( ! is_singular() ) {
        return $content;
    }

    $content = preg_replace( '/<img (.*?)class="(.*?)"(.*?)>/i', '<img $1class="$2 img-fluid"$3>', $content );
    $content = preg_replace( '/<img ((?:(?!class=).)*?)>/i', '<img class="img-fluid" $1>', $content );

    return $content;
}
add_filter( 'the_content', 'novaui_add_responsive_class_to_images' );

/**
 * Modifica el extracto para mostrar "..." al final
 *
 * @param string $more Texto mostrado al final del extracto.
 * @return string
 */
function novaui_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'novaui_excerpt_more' );

/**
 * Cambia la longitud del extracto
 *
 * @param int $length Longitud del extracto.
 * @return int
 */
function novaui_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'novaui_excerpt_length' );

/**
 * Detecta el tema preferido del usuario (claro u oscuro)
 *
 * @return string 'light' o 'dark'
 */
function novaui_get_preferred_theme() {
    $theme_option = get_theme_mod( 'novaui_default_mode', 'auto' );
    
    // Si el usuario ha seleccionado un tema específico en el customizer
    if ( $theme_option !== 'auto' ) {
        return $theme_option;
    }
    
    // Si hay una cookie con la preferencia del usuario
    if ( isset( $_COOKIE['theme_mode'] ) ) {
        return sanitize_text_field( $_COOKIE['theme_mode'] );
    }
    
    // Por defecto, tema claro
    return 'light';
}

/**
 * Agrega los íconos SVG inline en vez de usar imágenes
 *
 * @param string $icon Nombre del ícono.
 * @return string
 */
function novaui_get_icon_svg( $icon = 'home' ) {
    $icons = array(
        'home' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>',
        'search' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        'menu' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>',
        'close' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
        'user' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
        'moon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>',
        'sun' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>',
        'bell' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>',
        'calendar' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>',
        'clock' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
        'tag' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>',
        'comment' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>',
    );
    
    return isset( $icons[ $icon ] ) ? $icons[ $icon ] : '';
}

/**
 * Regenera los estilos personalizados basados en las variables CSS
 */
function novaui_regenerate_custom_css() {
    // Obtener opciones del tema
    $primary_color = get_theme_mod('novaui_primary_color', '#FF6B6B');
    $font_family = get_theme_mod('novaui_font_primary', "'Jost', 'Quicksand', sans-serif");
    $border_radius = get_theme_mod('novaui_border_radius', '8');
    
    // Generar CSS
    $custom_css = "
        :root {
            --color-primary: {$primary_color};
            --font-primary: {$font_family};
            --border-radius-md: {$border_radius}px;
        }
    ";
    
    // Actualizar opción en la BD
    update_option('novaui_custom_css', $custom_css);
    
    return $custom_css;
}

/**
 * Función para obtener versión minificada de un asset (para cacheo)
 * 
 * @param string $path Ruta al archivo
 * @return string
 */
function novaui_get_asset_version($path) {
    $file_path = get_template_directory() . $path;
    
    if (file_exists($file_path)) {
        return date('YmdHi', filemtime($file_path));
    }
    
    return NOVAUI_VERSION;
}

/**
 * Helper para determinar si una página es parte del dashboard
 * 
 * @return boolean
 */
function novaui_is_dashboard_page() {
    return is_page_template('page-templates/dashboard.php') || 
           (function_exists('is_account_page') && is_account_page()) ||
           (function_exists('is_woocommerce') && is_woocommerce() && is_user_logged_in());
}
