<?php
/**
 * Funciones para cargar scripts y estilos adicionales
 *
 * @package NovaUI
 */

/**
 * Cargar scripts y estilos adicionales para el tema
 */
function novaui_enqueue_additional_scripts() {
    // Si estamos en el dashboard, cargar Font Awesome desde CDN
    if (is_page_template(array('templates/dashboard.php', 'templates/chat-ai.php', 'templates/quick-links.php'))) {
        wp_enqueue_style(
            'font-awesome', 
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css',
            array(), 
            '6.2.0'
        );
    }
    
    // Cargar gráficos para el dashboard si es necesario
    if (is_page_template('templates/dashboard.php')) {
        wp_enqueue_script(
            'chart-js',
            'https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js',
            array(),
            '3.9.1',
            true
        );
        
        wp_enqueue_script(
            'novaui-charts',
            NOVAUI_JS . '/components/charts.js',
            array('jquery', 'chart-js'),
            NOVAUI_VERSION,
            true
        );
    }
    
    // Cargar componentes específicos según la plantilla
    if (is_page_template('templates/chat-ai.php')) {
        wp_enqueue_script(
            'novaui-chat',
            NOVAUI_JS . '/components/chat.js',
            array('jquery'),
            NOVAUI_VERSION,
            true
        );
    }
    
    if (is_page_template('templates/quick-links.php')) {
        wp_enqueue_script(
            'novaui-quick-links',
            NOVAUI_JS . '/components/quick-links.js',
            array('jquery'),
            NOVAUI_VERSION,
            true
        );
    }
    
    // Cargar script para el campo de búsqueda en header
    if (!is_404()) {
        wp_enqueue_script(
            'novaui-search',
            NOVAUI_JS . '/components/search.js',
            array('jquery'),
            NOVAUI_VERSION,
            true
        );
    }
    
    // Efectos de animación (opcional, basado en si está habilitado)
    if (get_theme_mod('novaui_enable_animations', true)) {
        wp_enqueue_script(
            'novaui-animations',
            NOVAUI_JS . '/components/animations.js',
            array('jquery'),
            NOVAUI_VERSION,
            true
        );
    }
    
    // Verificar si estamos en un post o página que tenga bloques
    if (is_singular() && has_blocks()) {
        wp_enqueue_style(
            'novaui-blocks',
            NOVAUI_CSS . '/components/blocks.css',
            array(),
            NOVAUI_VERSION
        );
    }
}
add_action('wp_enqueue_scripts', 'novaui_enqueue_additional_scripts', 15);

/**
 * Cargar estilos en el editor de Gutenberg
 */
function novaui_enqueue_block_editor_assets() {
    wp_enqueue_style(
        'novaui-editor-styles',
        NOVAUI_CSS . '/editor-style.css',
        array(),
        NOVAUI_VERSION
    );
    
    // Cargar script para personalizar el editor
    wp_enqueue_script(
        'novaui-editor-scripts',
        NOVAUI_JS . '/editor.js',
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
        NOVAUI_VERSION,
        true
    );
    
    // Pasar variables al script del editor
    wp_localize_script(
        'novaui-editor-scripts',
        'novaUIEditor',
        array(
            'colorScheme' => novaui_get_color_scheme(),
            'shadowValues' => novaui_get_shadow_values(),
        )
    );
}
add_action('enqueue_block_editor_assets', 'novaui_enqueue_block_editor_assets');

/**
 * Cargar estilos de inicio de sesión personalizados
 */
function novaui_login_styles() {
    wp_enqueue_style(
        'novaui-login-styles',
        NOVAUI_CSS . '/login.css',
        array(),
        NOVAUI_VERSION
    );
    
    // Cargar script para añadir efectos de neobrutalism en la página de inicio de sesión
    wp_enqueue_script(
        'novaui-login-scripts',
        NOVAUI_JS . '/login.js',
        array('jquery'),
        NOVAUI_VERSION,
        true
    );
}
add_action('login_enqueue_scripts', 'novaui_login_styles');

/**
 * Modificar enlace del logo en la página de inicio de sesión
 */
function novaui_login_logo_url() {
    return home_url('/');
}
add_filter('login_headerurl', 'novaui_login_logo_url');

/**
 * Modificar título del logo en la página de inicio de sesión
 */
function novaui_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'novaui_login_logo_url_title');

/**
 * Cargar estilos para el panel de administración
 */
function novaui_admin_styles() {
    // Solo si el usuario ha activado el tema de admin personalizado
    if (get_theme_mod('novaui_enable_admin_theme', false)) {
        wp_enqueue_style(
            'novaui-admin-styles',
            NOVAUI_CSS . '/admin.css',
            array(),
            NOVAUI_VERSION
        );
    }
}
add_action('admin_enqueue_scripts', 'novaui_admin_styles');

/**
 * Añadir variables CSS dinámicas al head
 */
function novaui_add_dynamic_css() {
    $color_scheme = novaui_get_color_scheme();
    $shadow_values = novaui_get_shadow_values();
    
    $css = "
    :root {
        --color-primary: {$color_scheme['primary']};
        --color-secondary: {$color_scheme['secondary']};
        --color-accent: {$color_scheme['accent']};
        --color-success: {$color_scheme['success']};
        --color-warning: {$color_scheme['warning']};
        --color-error: {$color_scheme['error']};
        --shadow-normal: {$shadow_values['normal']};
        --shadow-large: {$shadow_values['large']};
        --shadow-small: {$shadow_values['small']};
    }
    ";
    
    echo '<style type="text/css">' . $css . '</style>';
}
add_action('wp_head', 'novaui_add_dynamic_css', 5);

/**
 * Añadir clase al body basada en la intensidad del neobrutalism
 */
function novaui_intensity_body_class($classes) {
    $intensity = get_theme_mod('novaui_neobrutalism_intensity', 'medium');
    $classes[] = 'neobrutalism-' . $intensity;
    
    return $classes;
}
add_filter('body_class', 'novaui_intensity_body_class');

/**
 * Cargar JavaScript condicionalmente para IE
 */
function novaui_ie_scripts() {
    echo '<!--[if lt IE 9]>';
    echo '<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
    echo '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'novaui_ie_scripts', 1);

/**
 * Añadir atributos async/defer a scripts que no son críticos
 */
function novaui_async_defer_scripts($tag, $handle, $src) {
    // Lista de scripts que cargaremos con async
    $async_scripts = array(
        'novaui-animations',
        'chart-js',
    );
    
    // Lista de scripts que cargaremos con defer
    $defer_scripts = array(
        'novaui-theme-switcher',
    );
    
    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'novaui_async_defer_scripts', 10, 3);
