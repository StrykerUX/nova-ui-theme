<?php
/**
 * WooCommerce compatibility functions
 *
 * @package NovaUI
 */

/**
 * Comprobar si WooCommerce está activo
 */
function nova_ui_is_woocommerce_active() {
    return class_exists( 'WooCommerce' );
}

/**
 * Agregar tema oscuro/claro toggle en la parte superior del menú de cuenta de WooCommerce
 */
function nova_ui_woocommerce_account_dark_mode_toggle() {
    if ( get_theme_mod( 'nova_ui_show_dark_mode_toggle', true ) ) {
        ?>
        <div class="saas-dark-mode-toggle-container">
            <button id="dark-mode-toggle" class="saas-dark-mode-toggle" aria-label="<?php esc_attr_e( 'Toggle Dark Mode', 'nova-ui' ); ?>">
                <span class="saas-dark-mode-toggle__icon icon-moon"><?php echo nova_ui_get_svg_icon( 'moon', 'md' ); ?></span>
                <span class="saas-dark-mode-toggle__icon icon-sun"><?php echo nova_ui_get_svg_icon( 'sun', 'md' ); ?></span>
            </button>
        </div>
        <?php
    }
}
add_action( 'woocommerce_account_navigation', 'nova_ui_woocommerce_account_dark_mode_toggle', 5 );

/**
 * Agregar soporte WooCommerce
 */
function nova_ui_woocommerce_setup() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'nova_ui_woocommerce_setup' );

/**
 * Agregar clases a body en páginas de WooCommerce
 */
function nova_ui_woocommerce_body_class( $classes ) {
    if ( nova_ui_is_woocommerce_active() ) {
        $classes[] = 'woocommerce-active';
        
        // Añadir clase al checkout para estilo de checkout especializado
        if ( is_checkout() ) {
            $classes[] = 'saas-checkout';
        }
        
        // Añadir clase a la cuenta
        if ( is_account_page() ) {
            $classes[] = 'saas-account';
            
            // Verificar si estamos en la página de dashboard
            if ( is_wc_endpoint_url( 'dashboard' ) || ! is_wc_endpoint_url() ) {
                $classes[] = 'saas-account-dashboard';
            }
        }
        
        // Añadir clase a carrito
        if ( is_cart() ) {
            $classes[] = 'saas-cart';
        }
        
        // Añadir clase a productos individuales
        if ( is_product() ) {
            $classes[] = 'saas-single-product';
        }
    }
    
    return $classes;
}
add_filter( 'body_class', 'nova_ui_woocommerce_body_class' );

/**
 * Eliminar los títulos por defecto en determinadas páginas de WooCommerce
 */
function nova_ui_woocommerce_hide_page_title() {
    return false;
}
add_filter( 'woocommerce_show_page_title', 'nova_ui_woocommerce_hide_page_title' );

/**
 * Personalizar el wrapper de los templates de WooCommerce
 */
function nova_ui_woocommerce_wrapper_before() {
    ?>
    <main id="primary" class="site-main">
        <div class="saas-woocommerce-wrapper">
    <?php
}
add_action( 'woocommerce_before_main_content', 'nova_ui_woocommerce_wrapper_before', 10 );

/**
 * Cerrar el wrapper personalizado
 */
function nova_ui_woocommerce_wrapper_after() {
    ?>
        </div><!-- .saas-woocommerce-wrapper -->
    </main><!-- #primary -->
    <?php
}
add_action( 'woocommerce_after_main_content', 'nova_ui_woocommerce_wrapper_after', 10 );

/**
 * Personalizar el número de columnas en la página de tienda
 */
function nova_ui_woocommerce_loop_columns() {
    return 3; // Mostrar 3 productos por fila
}
add_filter( 'loop_shop_columns', 'nova_ui_woocommerce_loop_columns' );

/**
 * Personalizar el número de productos por página
 */
function nova_ui_woocommerce_products_per_page() {
    return 12; // Mostrar 12 productos por página
}
add_filter( 'loop_shop_per_page', 'nova_ui_woocommerce_products_per_page' );

/**
 * Personalizar los botones de WooCommerce para seguir el estilo neo-brutalista
 */
function nova_ui_woocommerce_buttons() {
    // Remover las clases por defecto de los botones
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    
    // Agregar nuevos botones con nuestras clases personalizadas
    add_action( 'woocommerce_before_shop_loop_item_title', 'nova_ui_woocommerce_show_product_sale_flash', 10 );
    add_action( 'woocommerce_after_shop_loop_item', 'nova_ui_woocommerce_template_loop_add_to_cart', 10 );
}
add_action( 'init', 'nova_ui_woocommerce_buttons' );

/**
 * Personalizar la etiqueta de oferta
 */
function nova_ui_woocommerce_show_product_sale_flash() {
    global $product;
    if ( $product->is_on_sale() ) {
        echo '<span class="saas-onsale">' . esc_html__( 'Sale', 'nova-ui' ) . '</span>';
    }
}

/**
 * Personalizar el botón de añadir al carrito
 */
function nova_ui_woocommerce_template_loop_add_to_cart() {
    global $product;
    
    $button_classes = 'saas-button saas-button--primary saas-button--sm saas-button--neobrutal';
    
    echo '<div class="saas-add-to-cart-container">';
    echo apply_filters(
        'woocommerce_loop_add_to_cart_link',
        sprintf(
            '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( $button_classes ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() )
        ),
        $product
    );
    echo '</div>';
}

/**
 * Personalizar el botón de checkout
 */
function nova_ui_woocommerce_button_classes( $args, $product ) {
    $args['class'] = str_replace( 'button', 'saas-button saas-button--primary saas-button--neobrutal', $args['class'] );
    return $args;
}
add_filter( 'woocommerce_product_add_to_cart_text', 'nova_ui_woocommerce_add_to_cart_text', 10, 2 );
add_filter( 'woocommerce_loop_add_to_cart_args', 'nova_ui_woocommerce_button_classes', 10, 2 );

/**
 * Personalizar el texto del botón añadir al carrito
 */
function nova_ui_woocommerce_add_to_cart_text( $text, $product ) {
    if ( $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() ) {
        $text = __( 'Add to Cart', 'nova-ui' );
    }
    return $text;
}

/**
 * Eliminar breadcrumbs por defecto de WooCommerce
 */
function nova_ui_remove_woocommerce_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'nova_ui_remove_woocommerce_breadcrumbs' );

/**
 * Agregar nuestros propios breadcrumbs personalizados
 */
function nova_ui_woocommerce_breadcrumbs() {
    if ( function_exists( 'nova_ui_breadcrumbs' ) ) {
        nova_ui_breadcrumbs();
    }
}
add_action( 'woocommerce_before_main_content', 'nova_ui_woocommerce_breadcrumbs', 20 );

/**
 * Personalizar el proceso de checkout
 */
function nova_ui_woocommerce_checkout_customization() {
    // Cambiar la posición del cuadro de cupón
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
    add_action( 'woocommerce_review_order_before_payment', 'woocommerce_checkout_coupon_form', 10 );
    
    // Mover el cuadro de pedido antes de los formularios en móvil
    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
    
    add_action( 'woocommerce_before_checkout_form', 'woocommerce_order_review', 5 );
    add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 10 );
}
add_action( 'init', 'nova_ui_woocommerce_checkout_customization' );

/**
 * Cambiar el orden de los campos en el formulario de checkout
 */
function nova_ui_woocommerce_checkout_fields( $fields ) {
    // Cambiar el orden de los campos
    $fields['billing']['billing_email']['priority'] = 5;
    $fields['billing']['billing_phone']['priority'] = 10;
    $fields['billing']['billing_first_name']['priority'] = 20;
    $fields['billing']['billing_last_name']['priority'] = 30;
    
    // Agregar placeholders
    $fields['billing']['billing_first_name']['placeholder'] = __( 'Your first name', 'nova-ui' );
    $fields['billing']['billing_last_name']['placeholder'] = __( 'Your last name', 'nova-ui' );
    $fields['billing']['billing_email']['placeholder'] = __( 'Your email address', 'nova-ui' );
    $fields['billing']['billing_phone']['placeholder'] = __( 'Your phone number', 'nova-ui' );
    
    // Agregar clases CSS personalizadas a los campos
    foreach ( $fields as $field_group => $field_array ) {
        foreach ( $field_array as $field_name => $field ) {
            $fields[$field_group][$field_name]['class'][] = 'saas-form-field';
            $fields[$field_group][$field_name]['input_class'][] = 'saas-input';
        }
    }
    
    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'nova_ui_woocommerce_checkout_fields' );

/**
 * Personalizar Mi Cuenta de WooCommerce
 */
function nova_ui_woocommerce_account_customization() {
    // Mover el contenido de bienvenida
    remove_action( 'woocommerce_account_dashboard', 'woocommerce_account_dashboard' );
    add_action( 'woocommerce_account_dashboard', 'nova_ui_woocommerce_account_dashboard' );
}
add_action( 'init', 'nova_ui_woocommerce_account_customization' );

/**
 * Contenido personalizado para el dashboard de Mi Cuenta
 */
function nova_ui_woocommerce_account_dashboard() {
    ?>
    <div class="saas-account-dashboard-content">
        <div class="saas-account-welcome">
            <h2><?php esc_html_e( 'Welcome to your dashboard', 'nova-ui' ); ?></h2>
            <p><?php esc_html_e( 'From your account dashboard you can view your recent orders, manage your account details, and more.', 'nova-ui' ); ?></p>
        </div>
        
        <div class="saas-account-quicklinks">
            <div class="saas-row">
                <?php
                $endpoints = wc_get_account_menu_items();
                
                // Remover el Dashboard ya que estamos en él
                if ( isset( $endpoints['dashboard'] ) ) {
                    unset( $endpoints['dashboard'] );
                }
                
                // Obtener iconos para cada endpoint
                $endpoint_icons = array(
                    'orders'          => 'file-text',
                    'downloads'       => 'download',
                    'edit-address'    => 'map-pin',
                    'edit-account'    => 'user',
                    'payment-methods' => 'credit-card',
                    'customer-logout' => 'log-out'
                );
                
                foreach ( $endpoints as $endpoint => $label ) :
                    $icon = isset( $endpoint_icons[$endpoint] ) ? $endpoint_icons[$endpoint] : 'chevron-right';
                    ?>
                    <div class="saas-column saas-col-6 saas-sm-col-12 saas-md-col-6">
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="saas-account-quicklink-card">
                            <div class="saas-account-quicklink-icon">
                                <?php echo nova_ui_get_svg_icon( $icon, 'md' ); ?>
                            </div>
                            <div class="saas-account-quicklink-content">
                                <h3><?php echo esc_html( $label ); ?></h3>
                                <span class="saas-account-quicklink-arrow">&rarr;</span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Personalizar los campos del formulario de registro
 */
function nova_ui_woocommerce_registration_fields() {
    ?>
    <p class="form-row form-row-wide">
        <label for="reg_username"><?php esc_html_e( 'Username', 'nova-ui' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text saas-input" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
    </p>
    
    <p class="form-row form-row-wide">
        <label for="reg_email"><?php esc_html_e( 'Email address', 'nova-ui' ); ?> <span class="required">*</span></label>
        <input type="email" class="input-text saas-input" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
    </p>
    
    <p class="form-row form-row-wide">
        <label for="reg_password"><?php esc_html_e( 'Password', 'nova-ui' ); ?> <span class="required">*</span></label>
        <input type="password" class="input-text saas-input" name="password" id="reg_password" autocomplete="new-password" />
    </p>
    
    <?php
}
add_action( 'woocommerce_register_form_start', 'nova_ui_woocommerce_registration_fields' );

/**
 * Soporte para WooCommerce Memberships si está activado
 */
function nova_ui_woocommerce_memberships_support() {
    if ( class_exists( 'WC_Memberships' ) ) {
        // Personalizar los mensajes de restricción de contenido
        add_filter( 'wc_memberships_content_restricted_message', 'nova_ui_memberships_restricted_message', 10, 3 );
        add_filter( 'wc_memberships_product_purchasing_restricted_message', 'nova_ui_memberships_purchasing_restricted_message', 10, 3 );
    }
}
add_action( 'init', 'nova_ui_woocommerce_memberships_support' );

/**
 * Personalizar el mensaje de contenido restringido
 */
function nova_ui_memberships_restricted_message( $message, $post_id, $args ) {
    $custom_message = '<div class="saas-restricted-content">';
    $custom_message .= '<h3>' . __( 'This content is exclusive to members', 'nova-ui' ) . '</h3>';
    $custom_message .= '<p>' . __( 'Join one of our membership plans to get access to this and other premium content.', 'nova-ui' ) . '</p>';
    $custom_message .= '<div class="saas-restricted-content-action">';
    $custom_message .= '<a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" class="saas-button saas-button--primary saas-button--neobrutal">' . __( 'View Plans', 'nova-ui' ) . '</a>';
    $custom_message .= '</div>';
    $custom_message .= '</div>';
    
    return $custom_message;
}

/**
 * Personalizar el mensaje de compra restringida
 */
function nova_ui_memberships_purchasing_restricted_message( $message, $product_id, $args ) {
    $custom_message = '<div class="saas-restricted-product">';
    $custom_message .= '<h3>' . __( 'This product is exclusive to members', 'nova-ui' ) . '</h3>';
    $custom_message .= '<p>' . __( 'Join one of our membership plans to get access to this and other premium products.', 'nova-ui' ) . '</p>';
    $custom_message .= '<div class="saas-restricted-product-action">';
    $custom_message .= '<a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" class="saas-button saas-button--primary saas-button--neobrutal">' . __( 'View Plans', 'nova-ui' ) . '</a>';
    $custom_message .= '</div>';
    $custom_message .= '</div>';
    
    return $custom_message;
}

/**
 * Enqueue scripts and styles específicos para WooCommerce
 */
function nova_ui_woocommerce_scripts() {
    if ( ! nova_ui_is_woocommerce_active() ) {
        return;
    }
    
    // Solo cargar en páginas de WooCommerce
    if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
        wp_enqueue_style( 'nova-ui-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce/woocommerce.css', array(), NOVA_UI_VERSION );
    }
}
add_action( 'wp_enqueue_scripts', 'nova_ui_woocommerce_scripts' );
