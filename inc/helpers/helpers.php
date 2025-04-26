<?php
/**
 * Funciones de ayuda para el tema NovaUI
 *
 * @package NovaUI
 */

// Cargar el archivo de iconos SVG
require_once get_template_directory() . '/inc/helpers/svg-icons.php';

/**
 * Muestra una navegación por migas de pan (breadcrumbs)
 */
function nova_ui_breadcrumbs() {
    // Si es la página principal, no mostramos breadcrumbs
    if ( is_front_page() ) {
        return;
    }
    
    echo '<div class="breadcrumbs">';
    
    // Inicio
    echo '<span class="breadcrumbs-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'nova-ui' ) . '</a></span>';
    echo '<span class="breadcrumbs-separator">/</span>';
    
    if ( is_category() || is_single() ) {
        // Categoría o entrada
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<span class="breadcrumbs-item"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></span>';
            echo '<span class="breadcrumbs-separator">/</span>';
        }
        
        if ( is_single() ) {
            // Si es una entrada individual, mostrar el título
            echo '<span class="breadcrumbs-item active">' . get_the_title() . '</span>';
        }
    } elseif ( is_page() ) {
        // Si es una página
        $parent_id = wp_get_post_parent_id( get_the_ID() );
        if ( $parent_id ) {
            // Si tiene padre, mostrar la jerarquía
            echo '<span class="breadcrumbs-item"><a href="' . esc_url( get_permalink( $parent_id ) ) . '">' . get_the_title( $parent_id ) . '</a></span>';
            echo '<span class="breadcrumbs-separator">/</span>';
        }
        
        echo '<span class="breadcrumbs-item active">' . get_the_title() . '</span>';
    } elseif ( is_search() ) {
        // Si es una búsqueda
        echo '<span class="breadcrumbs-item active">' . __( 'Search Results for', 'nova-ui' ) . ': "' . get_search_query() . '"</span>';
    } elseif ( is_404() ) {
        // Si es página 404
        echo '<span class="breadcrumbs-item active">' . __( 'Page Not Found', 'nova-ui' ) . '</span>';
    }
    
    echo '</div>';
}

/**
 * Genera un avatar para usuarios con las iniciales si no hay Gravatar
 *
 * @param string $avatar      Markup actual del avatar.
 * @param mixed  $id_or_email ID del usuario, correo o objeto.
 * @param int    $size        Tamaño del avatar.
 * @param string $default     URL del avatar por defecto.
 * @param string $alt         Texto alternativo.
 * @return string             Markup final del avatar.
 */
function nova_ui_custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    // Si ya hay un Gravatar, devolverlo
    if ( ! empty( $avatar ) && strpos( $avatar, 'gravatar.com' ) !== false ) {
        return $avatar;
    }
    
    // Obtener datos del usuario
    if ( is_numeric( $id_or_email ) ) {
        $user = get_user_by( 'id', $id_or_email );
    } elseif ( is_object( $id_or_email ) ) {
        if ( isset( $id_or_email->user_id ) && $id_or_email->user_id != 0 ) {
            $user = get_user_by( 'id', $id_or_email->user_id );
        } elseif ( isset( $id_or_email->comment_author_email ) ) {
            $user = get_user_by( 'email', $id_or_email->comment_author_email );
        }
    } else {
        $user = get_user_by( 'email', $id_or_email );
    }
    
    if ( $user && is_object( $user ) ) {
        // Obtener iniciales del nombre
        $first_initial = substr( $user->display_name, 0, 1 );
        
        // Colores de fondo disponibles
        $colors = array(
            '#FF6B6B', // Coral (primario)
            '#4ECDC4', // Teal (secundario)
            '#FFE66D', // Amarillo (acento)
            '#7BC950', // Verde (success)
            '#FFA552', // Naranja (warning)
        );
        
        // Asignar un color basado en el ID del usuario
        $color_index = ( $user->ID % count( $colors ) );
        $bg_color = $colors[ $color_index ];
        
        // Construir el avatar con iniciales
        $avatar = sprintf(
            '<div class="initial-avatar" style="background-color: %1$s; width: %2$dpx; height: %2$dpx; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: %3$dpx;" aria-hidden="true">%4$s</div>',
            $bg_color,
            $size,
            intval( $size / 2 ),
            esc_html( strtoupper( $first_initial ) )
        );
    }
    
    return $avatar;
}
add_filter( 'get_avatar', 'nova_ui_custom_avatar', 10, 5 );

/**
 * Determina si una página utiliza un template específico
 *
 * @param string $template_name Nombre del template a verificar.
 * @return boolean Verdadero si la página usa el template indicado.
 */
function nova_ui_is_template( $template_name ) {
    return is_page_template( "templates/{$template_name}.php" );
}

/**
 * Determina si un plugin está activo
 * 
 * @param string $plugin Nombre del plugin: folder/file.php
 * @return boolean Verdadero si el plugin está activo
 */
function nova_ui_is_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}

/**
 * Devuelve un array traducible de opciones para selectores
 *
 * @param string $option_group Nombre del grupo de opciones.
 * @return array Array de opciones.
 */
function nova_ui_get_options( $option_group = '' ) {
    $options = array();
    
    switch ( $option_group ) {
        case 'boolean':
            $options = array(
                'true'  => __( 'Yes', 'nova-ui' ),
                'false' => __( 'No', 'nova-ui' ),
            );
            break;
            
        case 'text_align':
            $options = array(
                'left'    => __( 'Left', 'nova-ui' ),
                'center'  => __( 'Center', 'nova-ui' ),
                'right'   => __( 'Right', 'nova-ui' ),
                'justify' => __( 'Justify', 'nova-ui' ),
            );
            break;
            
        case 'button_styles':
            $options = array(
                'primary'   => __( 'Primary', 'nova-ui' ),
                'secondary' => __( 'Secondary', 'nova-ui' ),
                'accent'    => __( 'Accent', 'nova-ui' ),
                'outline'   => __( 'Outline', 'nova-ui' ),
                'link'      => __( 'Link', 'nova-ui' ),
            );
            break;
            
        case 'button_sizes':
            $options = array(
                'sm' => __( 'Small', 'nova-ui' ),
                'md' => __( 'Medium', 'nova-ui' ),
                'lg' => __( 'Large', 'nova-ui' ),
                'xl' => __( 'Extra Large', 'nova-ui' ),
            );
            break;
    }
    
    return apply_filters( 'nova_ui_options_' . $option_group, $options );
}

/**
 * Función personalizada para mostrar el enlace de edición de post
 * con el estilo de NovaUI
 */
function nova_ui_edit_post_link() {
    edit_post_link(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Edit <span class="screen-reader-text">%s</span>', 'nova-ui' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            wp_kses_post( get_the_title() )
        ),
        '<span class="edit-link">',
        '</span>',
        null,
        'neo-button neo-button--outline neo-button--sm'
    );
}
