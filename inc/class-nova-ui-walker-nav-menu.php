<?php
/**
 * Walker de menú personalizado para Nova UI
 *
 * @package Nova_UI
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase para personalizar la salida del menú de navegación
 */
class Nova_UI_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
     * Iniciar el elemento de nivel superior (LI)
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Clase para elemento activo
        if (in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes) || in_array('current-menu-ancestor', $classes)) {
            $classes[] = 'active';
        }
        
        // Añadir clase para elementos con hijos
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'has-children';
        }
        
        // Filtrar clases
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        // ID del elemento
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        // Iniciar elemento LI
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        // Atributos para el enlace
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        $atts['class']  = 'menu-link';
        
        // Si tiene hijos, añadir atributos para submenu
        if (in_array('menu-item-has-children', $classes)) {
            $atts['class'] .= ' has-arrow';
            if ($depth === 0) {
                $atts['data-bs-toggle'] = 'collapse';
                $atts['data-bs-target'] = '#submenu-' . $item->ID;
                $atts['aria-expanded'] = 'false';
                $atts['aria-controls'] = 'submenu-' . $item->ID;
            }
        }
        
        // Filtrar atributos
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        // Construir atributos
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        // Construir icono del elemento
        $icon = '';
        
        // Buscar icono en las clases
        $icon_class = '';
        foreach ($classes as $class) {
            if (strpos($class, 'ti-') === 0) {
                $icon_class = $class;
                break;
            }
        }
        
        // Si no hay icono en las clases, verificar meta de página
        if (empty($icon_class) && ($item->type === 'post_type')) {
            $icon_meta = get_post_meta($item->object_id, '_nova_ui_menu_icon', true);
            if (!empty($icon_meta)) {
                $icon_class = $icon_meta;
            } else {
                // Iconos por defecto según profundidad
                if ($depth === 0) {
                    $icon_class = 'ti ti-dots';
                } else {
                    $icon_class = 'ti ti-circle';
                }
            }
        }
        
        // Si aún no hay icono, usar uno genérico
        if (empty($icon_class)) {
            if ($depth === 0) {
                $icon_class = 'ti ti-dots';
            } else {
                $icon_class = 'ti ti-circle';
            }
        }
        
        // Crear HTML del icono
        $icon = '<span class="menu-icon"><i class="' . esc_attr($icon_class) . '"></i></span>';
        
        // Iniciar el enlace
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $icon;
        $item_output .= '<span class="menu-text">';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</span>';
        
        // Flecha para elementos con hijos
        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= '<span class="menu-arrow"></span>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        // Filtrar salida
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * Iniciar sub-menú
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        
        // Clase según profundidad
        $submenu_class = '';
        if ($depth === 0) {
            $submenu_class = 'mm-collapse side-nav-second-level';
            $output .= "\n$indent<div class=\"collapse\" id=\"submenu-" . $args->parent_item_id . "\">\n";
        } elseif ($depth === 1) {
            $submenu_class = 'side-nav-third-level';
        }
        
        $output .= "\n$indent<ul class=\"$submenu_class\">\n";
    }
    
    /**
     * Cerrar sub-menú
     */
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
        
        if ($depth === 0) {
            $output .= "$indent</div>\n";
        }
    }
}
