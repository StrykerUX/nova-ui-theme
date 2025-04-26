<?php
/**
 * Funciones de integración con WooCommerce
 *
 * @package NovaUI
 */

/**
 * Inicialización de WooCommerce
 * 
 * Aquí definimos todo lo que necesitamos para asegurar que WooCommerce
 * funcione correctamente con nuestro tema.
 */
function novaui_woocommerce_setup() {
    // Declaramos compatibilidad con WooCommerce
    add_theme_support('woocommerce');
    
    // Añadimos soporte para las características de galería de productos
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Eliminamos los estilos por defecto de WooCommerce para aplicar los nuestros
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
}
add_action('after_setup_theme', 'novaui_woocommerce_setup');

/**
 * Incluir los estilos personalizados de WooCommerce
 */
function novaui_woocommerce_scripts() {
    wp_enqueue_style('novaui-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), NOVAUI_VERSION);
}
add_action('wp_enqueue_scripts', 'novaui_woocommerce_scripts');

/**
 * Envolver los productos en una clase personalizada
 */
function novaui_woocommerce_product_wrapper_start() {
    echo '<div class="novaui-woocommerce-product-wrapper">';
}
function novaui_woocommerce_product_wrapper_end() {
    echo '</div>';
}
add_action('woocommerce_before_main_content', 'novaui_woocommerce_product_wrapper_start', 15);
add_action('woocommerce_after_main_content', 'novaui_woocommerce_product_wrapper_end', 15);

/**
 * Cambiar el layout de las páginas de WooCommerce
 */
function novaui_woocommerce_body_classes($classes) {
    if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
        $classes[] = 'woocommerce-page';
        
        // Añadimos clases específicas para cada tipo de página
        if (is_cart()) {
            $classes[] = 'woocommerce-cart-page';
        } elseif (is_checkout()) {
            $classes[] = 'woocommerce-checkout-page';
        } elseif (is_account_page()) {
            $classes[] = 'woocommerce-account-page';
        } elseif (is_product()) {
            $classes[] = 'woocommerce-product-page';
        } elseif (is_shop() || is_product_category() || is_product_tag()) {
            $classes[] = 'woocommerce-shop-page';
        }
    }
    
    return $classes;
}
add_filter('body_class', 'novaui_woocommerce_body_classes');

/**
 * Personalizar el título de la tienda para mejor SEO
 */
function novaui_woocommerce_page_title($title) {
    if (is_shop()) {
        return get_theme_mod('novaui_woocommerce_shop_title', esc_html__('Shop', 'novaui'));
    }
    
    return $title;
}
add_filter('woocommerce_page_title', 'novaui_woocommerce_page_title');

/**
 * Modificar el número de columnas en la tienda
 */
function novaui_woocommerce_loop_columns() {
    return get_theme_mod('novaui_woocommerce_shop_columns', 3);
}
add_filter('loop_shop_columns', 'novaui_woocommerce_loop_columns');

/**
 * Modificar el número de productos por página
 */
function novaui_woocommerce_products_per_page() {
    return get_theme_mod('novaui_woocommerce_products_per_page', 12);
}
add_filter('loop_shop_per_page', 'novaui_woocommerce_products_per_page');

/**
 * Personalizar el botón de añadir al carrito
 */
function novaui_woocommerce_loop_add_to_cart_args($args, $product) {
    $args['class'] .= ' button ' . $product->get_type();
    
    return $args;
}
add_filter('woocommerce_loop_add_to_cart_args', 'novaui_woocommerce_loop_add_to_cart_args', 10, 2);

/**
 * Personalizar la forma en que se muestran los productos relacionados
 */
function novaui_woocommerce_related_products_args($args) {
    $args['posts_per_page'] = get_theme_mod('novaui_woocommerce_related_products', 4);
    $args['columns'] = get_theme_mod('novaui_woocommerce_related_columns', 4);
    
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'novaui_woocommerce_related_products_args');

/**
 * Cambiar el diseño de la página de checkout
 */
function novaui_woocommerce_checkout_fields($fields) {
    // Añadir clases a los campos del checkout
    foreach ($fields as $section => $section_fields) {
        foreach ($section_fields as $key => $field) {
            $fields[$section][$key]['class'][] = 'form-group';
            $fields[$section][$key]['input_class'][] = 'form-control';
            $fields[$section][$key]['label_class'][] = 'form-label';
        }
    }
    
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'novaui_woocommerce_checkout_fields');

/**
 * Personalizar el aspecto de los mensajes y notificaciones de WooCommerce
 */
function novaui_woocommerce_add_notice_classes($classes) {
    if (strpos($classes, 'woocommerce-error') !== false) {
        $classes .= ' alert alert-error';
    } elseif (strpos($classes, 'woocommerce-info') !== false) {
        $classes .= ' alert alert-info';
    } elseif (strpos($classes, 'woocommerce-message') !== false) {
        $classes .= ' alert alert-success';
    }
    
    return $classes;
}
add_filter('woocommerce_notice_types', 'novaui_woocommerce_add_notice_classes');

/**
 * Personalizar el widget de carrito en la cabecera
 */
function novaui_woocommerce_cart_link_fragment($fragments) {
    $fragments['a.cart-link .cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
    
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'novaui_woocommerce_cart_link_fragment');

/**
 * Personalizar la página Mi Cuenta
 */
function novaui_woocommerce_account_menu_items($items) {
    // Reordenar los items del menú de mi cuenta si es necesario
    return $items;
}
add_filter('woocommerce_account_menu_items', 'novaui_woocommerce_account_menu_items');

/**
 * Integración con WooCommerce Memberships (si está instalado)
 */
function novaui_woocommerce_memberships_integration() {
    if (!class_exists('WC_Memberships')) {
        return;
    }
    
    // Personalizar los mensajes de restricción de contenido
    add_filter('wc_memberships_restricted_message', 'novaui_woocommerce_memberships_restricted_message', 10, 3);
    
    // Personalizar la apariencia de los planes de membresía
    add_action('wc_memberships_before_my_memberships', 'novaui_woocommerce_before_my_memberships');
    add_action('wc_memberships_after_my_memberships', 'novaui_woocommerce_after_my_memberships');
}
add_action('init', 'novaui_woocommerce_memberships_integration');

/**
 * Personalizar los mensajes de restricción de contenido
 */
function novaui_woocommerce_memberships_restricted_message($message, $post_id, $access_time) {
    if (is_product()) {
        // Mensaje personalizado para productos restringidos
        return get_theme_mod('novaui_woocommerce_memberships_product_message', 
            esc_html__('This product is only available to members. Please sign up for a membership plan to access this product.', 'novaui'));
    } else {
        // Mensaje personalizado para contenido restringido
        return get_theme_mod('novaui_woocommerce_memberships_content_message', 
            esc_html__('This content is only available to members. Please sign up for a membership plan to access this content.', 'novaui'));
    }
    
    return $message;
}

/**
 * Añadir estilos antes de la sección Mi Membresía
 */
function novaui_woocommerce_before_my_memberships() {
    echo '<div class="novaui-memberships-wrapper">';
}

/**
 * Cerrar el contenedor después de la sección Mi Membresía
 */
function novaui_woocommerce_after_my_memberships() {
    echo '</div>';
}

/**
 * Integración con WooCommerce Teams for Memberships (si está instalado)
 */
function novaui_woocommerce_teams_integration() {
    if (!class_exists('WC_Memberships_For_Teams')) {
        return;
    }
    
    // Personalizar la apariencia de equipos
    add_action('wc_memberships_for_teams_before_my_teams', 'novaui_woocommerce_before_my_teams');
    add_action('wc_memberships_for_teams_after_my_teams', 'novaui_woocommerce_after_my_teams');
}
add_action('init', 'novaui_woocommerce_teams_integration');

/**
 * Añadir estilos antes de la sección Mis Equipos
 */
function novaui_woocommerce_before_my_teams() {
    echo '<div class="novaui-teams-wrapper">';
}

/**
 * Cerrar el contenedor después de la sección Mis Equipos
 */
function novaui_woocommerce_after_my_teams() {
    echo '</div>';
}

/**
 * Personalizar el proceso de checkout
 */
function novaui_woocommerce_customize_checkout() {
    // Ajustar el orden de los pasos del checkout si es necesario
    
    // Añadir pasos personalizados al checkout
    add_action('woocommerce_before_checkout_form', 'novaui_woocommerce_checkout_step_indicator', 10);
}
add_action('init', 'novaui_woocommerce_customize_checkout');

/**
 * Añadir indicador de pasos al checkout
 */
function novaui_woocommerce_checkout_step_indicator() {
    if (!is_checkout()) {
        return;
    }
    
    // Solo mostrar el indicador de pasos si está habilitado en el personalizador
    if (!get_theme_mod('novaui_woocommerce_checkout_steps', true)) {
        return;
    }
    
    // Determinar el paso actual
    $current_step = 1; // Por defecto, información de facturación
    
    if (isset($_GET['step'])) {
        $current_step = intval($_GET['step']);
    }
    
    // Pasos del checkout
    $steps = array(
        1 => esc_html__('Cart', 'novaui'),
        2 => esc_html__('Billing & Shipping', 'novaui'),
        3 => esc_html__('Payment', 'novaui'),
        4 => esc_html__('Confirmation', 'novaui')
    );
    
    // Mostrar el indicador de pasos
    echo '<div class="checkout-steps">';
    echo '<ul>';
    
    foreach ($steps as $step_number => $step_label) {
        $step_class = ($step_number == $current_step) ? 'active' : '';
        $step_class .= ($step_number < $current_step) ? ' completed' : '';
        
        echo '<li class="' . esc_attr($step_class) . '">';
        echo '<span class="step-number">' . esc_html($step_number) . '</span>';
        echo '<span class="step-label">' . esc_html($step_label) . '</span>';
        echo '</li>';
    }
    
    echo '</ul>';
    echo '</div>';
}

/**
 * Modificar las plantillas de correo electrónico de WooCommerce
 */
function novaui_woocommerce_email_customization() {
    // Añadir estilos personalizados a los correos electrónicos
    add_filter('woocommerce_email_styles', 'novaui_woocommerce_email_styles');
    
    // Personalizar el pie de página de los correos electrónicos
    add_filter('woocommerce_email_footer_text', 'novaui_woocommerce_email_footer_text');
}
add_action('init', 'novaui_woocommerce_email_customization');

/**
 * Personalizar los estilos de los correos electrónicos
 */
function novaui_woocommerce_email_styles($css) {
    // Añadir estilos personalizados a los correos electrónicos
    $css .= '
        .soft-neubrutalism-style {
            border: 2px solid #333;
            border-radius: 8px;
            box-shadow: 6px 6px 0 rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .order-details {
            background-color: #f5f5f5;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 15px;
        }
        
        h2 {
            color: ' . get_theme_mod('novaui_primary_color', '#FF6B6B') . ';
        }
    ';
    
    return $css;
}

/**
 * Personalizar el texto del pie de página de los correos electrónicos
 */
function novaui_woocommerce_email_footer_text($text) {
    // Obtener el texto personalizado del pie de página desde el personalizador
    $custom_footer_text = get_theme_mod('novaui_woocommerce_email_footer', '');
    
    if (!empty($custom_footer_text)) {
        return $custom_footer_text;
    }
    
    return $text;
}
