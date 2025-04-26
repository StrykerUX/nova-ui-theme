<?php
/**
 * Funciones que mejoran el tema añadiendo características personalizadas
 *
 * @package NovaUI
 */

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
 * Cargar el archivo de iconos Lucide
 * Esto mejora la función nova_ui_get_svg_icon() que ya está definida en template-tags.php
 */
function nova_ui_load_lucide_icons() {
    // Solo cargar si el archivo existe
    $lucide_icons_path = get_template_directory() . '/inc/lucide-icons.php';
    if (file_exists($lucide_icons_path)) {
        include_once $lucide_icons_path;
    }
}
add_action('init', 'nova_ui_load_lucide_icons');

/**
 * Añadir soporte para modo oscuro
 */
function nova_ui_dark_mode_support() {
    // Agregar soporte para detección de preferencia del sistema
    add_theme_support('dark-mode');
    
    // Añadir clases específicas para modo oscuro basadas en la configuración
    $theme_options = get_option('novastudio_options', array());
    $default_mode = isset($theme_options['theme']['default_mode']) ? $theme_options['theme']['default_mode'] : 'auto';
    
    if ($default_mode === 'dark') {
        add_filter('body_class', function($classes) {
            $classes[] = 'dark-mode';
            return $classes;
        });
    }
}
add_action('after_setup_theme', 'nova_ui_dark_mode_support');

/**
 * Añadir variables CSS personalizadas basadas en las opciones del tema
 */
function nova_ui_custom_css_variables() {
    $theme_options = get_option('novastudio_options', array());
    
    // Si no hay opciones, no hacer nada
    if (empty($theme_options)) {
        return;
    }
    
    // Obtener colores personalizados
    $colors = isset($theme_options['colors']) ? $theme_options['colors'] : array();
    
    // Obtener tipografía personalizada
    $typography = isset($theme_options['typography']) ? $theme_options['typography'] : array();
    
    // Si no hay colores ni tipografía personalizados, no hacer nada
    if (empty($colors) && empty($typography)) {
        return;
    }
    
    // Iniciar el bloque de estilos
    echo "<style id='nova-ui-custom-properties'>\n";
    echo ":root {\n";
    
    // Variables de colores
    if (!empty($colors)) {
        foreach ($colors as $key => $value) {
            if (empty($value)) continue;
            echo "  --color-{$key}: {$value};\n";
        }
    }
    
    // Variables de tipografía
    if (!empty($typography)) {
        if (!empty($typography['font_primary'])) {
            echo "  --font-primary: {$typography['font_primary']};\n";
        }
        
        if (!empty($typography['font_secondary'])) {
            echo "  --font-secondary: {$typography['font_secondary']};\n";
        }
        
        if (!empty($typography['base_size'])) {
            echo "  --font-size-base: {$typography['base_size']};\n";
        }
    }
    
    // Cerrar el bloque root
    echo "}\n";
    echo "</style>\n";
}
add_action('wp_head', 'nova_ui_custom_css_variables', 9);
