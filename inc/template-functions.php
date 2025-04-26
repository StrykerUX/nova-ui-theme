<?php
/**
 * Funciones que mejoran el tema añadiendo características personalizadas
 *
 * @package NovaUI
 */

/**
 * Obtener un icono SVG de Lucide Icons
 *
 * @param string $icon Nombre del icono a mostrar
 * @param string $size Tamaño del icono (sm, md, lg)
 * @return string HTML del icono SVG
 */
function nova_ui_get_svg_icon($icon, $size = 'md') {
    // Mapeo de tamaños a píxeles
    $sizes = array(
        'sm' => 16,
        'md' => 20,
        'lg' => 24,
        'xl' => 32,
    );
    
    // Asegurar que el tamaño es válido
    if (!isset($sizes[$size])) {
        $size = 'md';
    }
    
    $pixel_size = $sizes[$size];
    
    // Incluir iconos de Lucide
    $lucide_icons = include_once(get_template_directory() . '/inc/lucide-icons.php');
    
    // Si el icono no existe, devolver un icono de "ayuda" por defecto
    if (!isset($lucide_icons[$icon])) {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="'.$pixel_size.'" height="'.$pixel_size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide-help-circle"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>';
        return $svg;
    }
    
    // Obtener el icono SVG y ajustar sus dimensiones
    $svg = $lucide_icons[$icon];
    $svg = str_replace('width="24"', 'width="'.$pixel_size.'"', $svg);
    $svg = str_replace('height="24"', 'height="'.$pixel_size.'"', $svg);
    
    return $svg;
}

/**
 * Añadir clases al body dependiendo de las opciones del tema
 *
 * @param array $classes Clases actuales del body
 * @return array Clases actualizadas
 */
function nova_ui_body_classes($classes) {
    // Añadir clase para modo oscuro si está activado por defecto
    $default_mode = get_option('novastudio_options', array());
    if (isset($default_mode['theme']['default_mode']) && $default_mode['theme']['default_mode'] === 'dark') {
        $classes[] = 'dark-mode';
    }
    
    // Clase para sidebar colapsado
    if (get_theme_mod('nova_ui_collapse_sidebar', false)) {
        $classes[] = 'sidebar-collapsed';
    }
    
    return $classes;
}
add_filter('body_class', 'nova_ui_body_classes');

/**
 * Generar breadcrumbs para las páginas
 */
function nova_ui_breadcrumbs() {
    // No mostrar en la página de inicio
    if (is_front_page()) {
        return;
    }
    
    echo '<div class="nova-breadcrumbs">';
    
    // Enlace a la página de inicio
    echo '<a href="' . esc_url(home_url('/')) . '" class="nova-breadcrumb-item">' . esc_html__('Home', 'nova-ui') . '</a>';
    echo '<span class="nova-breadcrumb-separator">' . nova_ui_get_svg_icon('chevron-right', 'sm') . '</span>';
    
    if (is_category() || is_single()) {
        // Categoría del post
        if (is_single()) {
            $categories = get_the_category();
            if (!empty($categories)) {
                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="nova-breadcrumb-item">' . esc_html($categories[0]->name) . '</a>';
                echo '<span class="nova-breadcrumb-separator">' . nova_ui_get_svg_icon('chevron-right', 'sm') . '</span>';
            }
            // Título del post
            echo '<span class="nova-breadcrumb-item nova-breadcrumb-current">' . get_the_title() . '</span>';
        } else {
            // Página de categoría
            echo '<span class="nova-breadcrumb-item nova-breadcrumb-current">' . single_cat_title('', false) . '</span>';
        }
    } elseif (is_page()) {
        // Si es una subpágina, mostrar la jerarquía
        if ($post->post_parent) {
            $ancestors = get_post_ancestors($post->ID);
            $ancestors = array_reverse($ancestors);
            
            foreach ($ancestors as $ancestor) {
                echo '<a href="' . esc_url(get_permalink($ancestor)) . '" class="nova-breadcrumb-item">' . esc_html(get_the_title($ancestor)) . '</a>';
                echo '<span class="nova-breadcrumb-separator">' . nova_ui_get_svg_icon('chevron-right', 'sm') . '</span>';
            }
        }
        
        // Título de la página actual
        echo '<span class="nova-breadcrumb-item nova-breadcrumb-current">' . get_the_title() . '</span>';
    } elseif (is_search()) {
        // Página de resultados de búsqueda
        echo '<span class="nova-breadcrumb-item nova-breadcrumb-current">' . esc_html__('Search Results for: ', 'nova-ui') . get_search_query() . '</span>';
    } elseif (is_404()) {
        // Página 404
        echo '<span class="nova-breadcrumb-item nova-breadcrumb-current">' . esc_html__('404 Not Found', 'nova-ui') . '</span>';
    }
    
    echo '</div>';
}
