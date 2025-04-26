<?php
/**
 * Funciones para modificar las plantillas
 *
 * @package NovaUI
 */

/**
 * Añadir clases al body basadas en el contexto
 *
 * @param array $classes Clases del body.
 * @return array
 */
function novaui_body_classes($classes) {
    // Añadir clase basada en si tiene o no sidebar
    if (!is_active_sidebar('sidebar-1') || is_page_template('templates/full-width.php') || is_page_template('templates/no-sidebar.php')) {
        $classes[] = 'no-sidebar';
    }

    // Añadir clase para página de inicio
    if (is_front_page() && is_home()) {
        $classes[] = 'nova-home';
    }

    // Añadir clase para páginas de archivo
    if (is_archive() || is_search()) {
        $classes[] = 'nova-archive';
    }

    // Añadir clase para posts
    if (is_singular('post')) {
        $classes[] = 'nova-single-post';
    }
    
    // Añadir clase para páginas
    if (is_page() && !is_front_page()) {
        $classes[] = 'nova-page';
    }
    
    // Añadir clase para modo oscuro/claro según preferencia
    $classes[] = novaui_theme_mode_class();
    
    // Añadir clase para intensidad del neobrutalism
    $neobrutalism_intensity = get_theme_mod('novaui_neobrutalism_intensity', 'medium');
    $classes[] = 'neobrutalism-' . $neobrutalism_intensity;
    
    // Añadir clase si es dashboard
    if (is_page_template('templates/dashboard.php') || 
        is_page_template('templates/chat-ai.php') || 
        is_page_template('templates/quick-links.php') ||
        isset($GLOBALS['novaui_is_dashboard']) && $GLOBALS['novaui_is_dashboard']) {
        $classes[] = 'nova-dashboard';
    }
    
    return $classes;
}
add_filter('body_class', 'novaui_body_classes');

/**
 * Añadir clase para la etiqueta del sitio
 */
function novaui_site_title_classes($title, $id) {
    if (is_front_page() && is_home()) {
        return $title . ' nova-site-title';
    }
    
    return $title;
}
add_filter('the_title', 'novaui_site_title_classes', 10, 2);

/**
 * Añadir clases de diseño neobrutalism a elementos
 */
function novaui_add_neobrutalism_classes($content) {
    // Convertir tablas en estilo neobrutalism
    $content = str_replace('<table', '<table class="nova-table"', $content);
    
    // Convertir formularios en estilo neobrutalism
    $content = str_replace('<form', '<form class="nova-form"', $content);
    
    // Convertir inputs en estilo neobrutalism
    $content = str_replace('<input', '<input class="nova-input"', $content);
    
    // Convertir botones en estilo neobrutalism
    $content = str_replace('<button', '<button class="nova-button"', $content);
    
    return $content;
}
add_filter('the_content', 'novaui_add_neobrutalism_classes');

/**
 * Filtrar clases de menú de navegación
 */
function novaui_nav_menu_css_class($classes, $item, $args) {
    if ('primary' === $args->theme_location) {
        $classes[] = 'nova-menu-item';
    }
    
    if ('dashboard-sidebar' === $args->theme_location) {
        $classes[] = 'dashboard-nav-item';
    }
    
    return $classes;
}
add_filter('nav_menu_css_class', 'novaui_nav_menu_css_class', 10, 3);

/**
 * Filtrar los atributos de los links de menú
 */
function novaui_nav_menu_link_attributes($atts, $item, $args) {
    if ('primary' === $args->theme_location) {
        $atts['class'] = isset($atts['class']) ? $atts['class'] . ' nova-menu-link' : 'nova-menu-link';
    }
    
    if ('dashboard-sidebar' === $args->theme_location) {
        $atts['class'] = isset($atts['class']) ? $atts['class'] . ' dashboard-nav-link' : 'dashboard-nav-link';
    }
    
    return $atts;
}
add_filter('nav_menu_link_attributes', 'novaui_nav_menu_link_attributes', 10, 3);

/**
 * Modificar el output de los comentarios
 */
function novaui_comment_form_defaults($defaults) {
    $defaults['comment_field'] = str_replace('textarea', 'textarea class="nova-textarea"', $defaults['comment_field']);
    $defaults['submit_button'] = '<button type="submit" id="%2$s" class="nova-button %3$s">%4$s</button>';
    $defaults['title_reply_before'] = '<h3 id="reply-title" class="comment-reply-title nova-title">';
    $defaults['title_reply_after'] = '</h3>';
    
    return $defaults;
}
add_filter('comment_form_defaults', 'novaui_comment_form_defaults');

/**
 * Modificar los argumentos de los comentarios
 */
function novaui_comment_form_fields($fields) {
    foreach ($fields as $key => $field) {
        $fields[$key] = str_replace('input', 'input class="nova-input"', $field);
    }
    
    return $fields;
}
add_filter('comment_form_default_fields', 'novaui_comment_form_fields');

/**
 * Añadir estructura de metadatos a los elementos del tema
 */
function novaui_post_meta($post_id = null) {
    if (is_null($post_id)) {
        $post_id = get_the_ID();
    }
    
    echo '<div class="nova-post-meta">';
    
    // Fecha
    echo '<span class="nova-post-date">';
    echo '<i class="fas fa-calendar-alt"></i> ';
    echo get_the_date('', $post_id);
    echo '</span>';
    
    // Autor
    echo '<span class="nova-post-author">';
    echo '<i class="fas fa-user"></i> ';
    echo get_the_author_meta('display_name', get_post_field('post_author', $post_id));
    echo '</span>';
    
    // Categorías
    $categories = get_the_category($post_id);
    if (!empty($categories)) {
        echo '<span class="nova-post-categories">';
        echo '<i class="fas fa-folder"></i> ';
        
        $cat_links = array();
        foreach ($categories as $category) {
            $cat_links[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
        }
        
        echo implode(', ', $cat_links);
        echo '</span>';
    }
    
    // Comentarios
    $comment_count = get_comments_number($post_id);
    echo '<span class="nova-post-comments">';
    echo '<i class="fas fa-comment"></i> ';
    
    if ($comment_count == 0) {
        echo esc_html__('Sin comentarios', 'novaui');
    } elseif ($comment_count == 1) {
        echo esc_html__('1 comentario', 'novaui');
    } else {
        echo sprintf(
            esc_html__('%d comentarios', 'novaui'),
            $comment_count
        );
    }
    
    echo '</span>';
    
    echo '</div>';
}

/**
 * Añadir clases a títulos para estilo neobrutalism
 */
function novaui_post_title($title, $id = null) {
    if (in_the_loop() && is_main_query()) {
        return '<span class="neo-title-text">' . $title . '</span>';
    }
    
    return $title;
}
add_filter('the_title', 'novaui_post_title', 10, 2);

/**
 * Registrar soporte para atributos de menú personalizados
 */
function novaui_nav_menu_item_custom_fields($item_id, $item) {
    if ('dashboard-sidebar' !== $item->theme_location) {
        return;
    }
    ?>
    <p class="field-icon description description-thin">
        <label for="edit-menu-item-icon-<?php echo $item_id; ?>">
            <?php esc_html_e('Icono (clase FontAwesome)', 'novaui'); ?><br>
            <input type="text" id="edit-menu-item-icon-<?php echo $item_id; ?>" class="widefat code edit-menu-item-icon" name="menu-item-icon[<?php echo $item_id; ?>]" value="<?php echo esc_attr(get_post_meta($item_id, '_menu_item_icon', true)); ?>">
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'novaui_nav_menu_item_custom_fields', 10, 2);

/**
 * Guardar atributos de menú personalizados
 */
function novaui_update_nav_menu_item($menu_id, $menu_item_db_id) {
    if (isset($_POST['menu-item-icon'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_icon', sanitize_text_field($_POST['menu-item-icon'][$menu_item_db_id]));
    }
}
add_action('wp_update_nav_menu_item', 'novaui_update_nav_menu_item', 10, 2);

/**
 * Función para generar clase de tarjeta neo-brutalista
 */
function novaui_card($content = '', $attributes = array()) {
    $default_attrs = array(
        'class' => 'nova-card',
        'style' => '',
    );
    
    $attrs = wp_parse_args($attributes, $default_attrs);
    
    $attr_string = '';
    foreach ($attrs as $attr => $value) {
        if (!empty($value)) {
            $attr_string .= ' ' . $attr . '="' . esc_attr($value) . '"';
        }
    }
    
    return '<div' . $attr_string . '>' . $content . '</div>';
}

/**
 * Función para generar botón neo-brutalista
 */
function novaui_button($text, $url = '#', $attributes = array()) {
    $default_attrs = array(
        'class' => 'nova-button',
        'style' => '',
    );
    
    $attrs = wp_parse_args($attributes, $default_attrs);
    
    $attr_string = '';
    foreach ($attrs as $attr => $value) {
        if (!empty($value)) {
            $attr_string .= ' ' . $attr . '="' . esc_attr($value) . '"';
        }
    }
    
    return '<a href="' . esc_url($url) . '"' . $attr_string . '>' . $text . '</a>';
}

/**
 * Añadir clase a imágenes en el editor
 */
function novaui_image_send_to_editor($html, $id, $caption, $title, $align, $url, $size, $alt) {
    $html = str_replace('<img', '<img class="nova-image"', $html);
    
    return $html;
}
add_filter('image_send_to_editor', 'novaui_image_send_to_editor', 10, 8);
