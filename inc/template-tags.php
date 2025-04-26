<?php
/**
 * Funciones de plantilla personalizadas para este tema
 *
 * @package Nova_UI
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Muestra la fecha de publicación formateada para uso en HTML
 */
function nova_ui_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        /* translators: %s: fecha de publicación. */
        esc_html_x('Publicado el %s', 'fecha de publicación', 'nova-ui'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Muestra el nombre del autor
 */
function nova_ui_posted_by() {
    $byline = sprintf(
        /* translators: %s: nombre del autor. */
        esc_html_x('por %s', 'nombre del autor', 'nova-ui'),
        '<a class="author-link" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'
    );

    echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Muestra avatar del autor o iniciales
 * 
 * @param int $user_id ID del usuario.
 * @param int $size Tamaño del avatar.
 */
function nova_ui_author_avatar($user_id = null, $size = 40) {
    if (null === $user_id) {
        $user_id = get_the_author_meta('ID');
    }
    
    $avatar = get_avatar($user_id, $size);
    
    if (!$avatar) {
        $user_name = get_the_author_meta('display_name', $user_id);
        $initials = nova_ui_get_initials($user_name);
        $bg_color = nova_ui_generate_color($user_name);
        
        echo '<div class="author-initials" style="width: ' . esc_attr($size) . 'px; height: ' . esc_attr($size) . 'px; background-color: ' . esc_attr($bg_color) . ';">';
        echo esc_html($initials);
        echo '</div>';
    } else {
        echo $avatar; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}

/**
 * Muestra categorías de la entrada
 */
function nova_ui_entry_categories() {
    // Verificar si es una entrada
    if ('post' !== get_post_type()) {
        return;
    }
    
    $categories_list = get_the_category_list(', ');
    if ($categories_list) {
        echo '<div class="entry-categories">';
        echo '<span class="cat-label">' . esc_html__('Categorías:', 'nova-ui') . '</span>';
        echo '<span class="cat-links">' . $categories_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '</div>';
    }
}

/**
 * Muestra etiquetas de la entrada
 */
function nova_ui_entry_tags() {
    // Verificar si es una entrada
    if ('post' !== get_post_type()) {
        return;
    }
    
    $tags_list = get_the_tag_list('', ', ');
    if ($tags_list) {
        echo '<div class="entry-tags">';
        echo '<span class="tag-label">' . esc_html__('Etiquetas:', 'nova-ui') . '</span>';
        echo '<span class="tag-links">' . $tags_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '</div>';
    }
}

/**
 * Muestra enlace de comentarios
 */
function nova_ui_comment_link() {
    if (!post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        echo '<i class="ti ti-message-circle"></i> ';
        
        comments_popup_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Nombre de la entrada. Solo visible para lectores de pantalla. */
                    __('Deja un comentario<span class="screen-reader-text"> en %s</span>', 'nova-ui'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            )
        );
        echo '</span>';
    }
}

/**
 * Muestra enlace para editar entrada
 */
function nova_ui_edit_link() {
    edit_post_link(
        sprintf(
            wp_kses(
                /* translators: %s: Nombre de la entrada. Solo visible para lectores de pantalla. */
                __('Editar <span class="screen-reader-text">%s</span>', 'nova-ui'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<span class="edit-link"><i class="ti ti-edit"></i> ',
        '</span>'
    );
}

/**
 * Muestra la imagen destacada con efecto Neo Brutalismo
 * 
 * @param string $size Tamaño de la imagen.
 */
function nova_ui_post_thumbnail($size = 'large') {
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
        return;
    }
    
    echo '<div class="post-thumbnail neo-brutalism">';
    the_post_thumbnail($size, array(
        'alt' => the_title_attribute(array(
            'echo' => false,
        )),
    ));
    echo '</div>';
}

/**
 * Muestra título de página con diseño Neo Brutalismo
 */
function nova_ui_page_title_display() {
    echo '<div class="page-title-container">';
    echo '<h1 class="page-title neo-brutalism">' . get_the_title() . '</h1>';
    echo '</div>';
}

/**
 * Muestra navegación de paginación
 */
function nova_ui_pagination() {
    $args = array(
        'prev_text' => '<i class="ti ti-chevron-left"></i> ' . __('Anterior', 'nova-ui'),
        'next_text' => __('Siguiente', 'nova-ui') . ' <i class="ti ti-chevron-right"></i>',
        'mid_size'  => 2,
        'class'     => 'pagination-container',
    );
    
    echo '<nav class="navigation pagination neo-brutalism">';
    echo '<div class="nav-links">';
    echo paginate_links($args); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '</div>';
    echo '</nav>';
}

/**
 * Muestra la fecha de la entrada con icono
 */
function nova_ui_entry_date() {
    echo '<div class="entry-date">';
    echo '<i class="ti ti-calendar"></i> ';
    echo get_the_date();
    echo '</div>';
}

/**
 * Muestra un contador de tiempo de lectura
 */
function nova_ui_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 palabras por minuto en promedio
    
    if ($reading_time < 1) {
        $reading_time = 1;
    }
    
    echo '<div class="reading-time">';
    echo '<i class="ti ti-clock"></i> ';
    printf(
        /* translators: %d: tiempo de lectura en minutos. */
        _n(
            '%d min de lectura',
            '%d mins de lectura',
            $reading_time,
            'nova-ui'
        ),
        $reading_time
    );
    echo '</div>';
}

/**
 * Muestra los botones para compartir en redes sociales
 */
function nova_ui_social_share() {
    $title = get_the_title();
    $permalink = get_permalink();
    
    echo '<div class="social-share">';
    echo '<span class="share-label">' . esc_html__('Compartir:', 'nova-ui') . '</span>';
    
    // Twitter/X
    echo '<a href="' . esc_url('https://twitter.com/intent/tweet?text=' . $title . '&url=' . $permalink) . '" target="_blank" rel="noopener noreferrer" class="share-button twitter">';
    echo '<i class="ti ti-brand-twitter"></i>';
    echo '</a>';
    
    // Facebook
    echo '<a href="' . esc_url('https://www.facebook.com/sharer/sharer.php?u=' . $permalink) . '" target="_blank" rel="noopener noreferrer" class="share-button facebook">';
    echo '<i class="ti ti-brand-facebook"></i>';
    echo '</a>';
    
    // LinkedIn
    echo '<a href="' . esc_url('https://www.linkedin.com/shareArticle?mini=true&url=' . $permalink . '&title=' . $title) . '" target="_blank" rel="noopener noreferrer" class="share-button linkedin">';
    echo '<i class="ti ti-brand-linkedin"></i>';
    echo '</a>';
    
    // WhatsApp
    echo '<a href="' . esc_url('https://api.whatsapp.com/send?text=' . $title . ' ' . $permalink) . '" target="_blank" rel="noopener noreferrer" class="share-button whatsapp">';
    echo '<i class="ti ti-brand-whatsapp"></i>';
    echo '</a>';
    
    echo '</div>';
}
