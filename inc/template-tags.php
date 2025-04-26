<?php
/**
 * Funciones de plantilla personalizadas
 *
 * Funciones que mejoran el tema añadiendo etiquetas de plantilla personalizadas
 *
 * @package NovaUI
 */

if (!function_exists('novaui_posted_on')) :
    /**
     * Imprime la meta información de fecha/autor para la publicación actual.
     */
    function novaui_posted_on() {
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
            /* translators: %s: post date. */
            esc_html_x('Publicado el %s', 'post date', 'novaui'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('por %s', 'post author', 'novaui'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<div class="nova-posted-on"><i class="fas fa-calendar-alt"></i> ' . $posted_on . '</div>';
        echo '<div class="nova-byline"><i class="fas fa-user"></i> ' . $byline . '</div>';
    }
endif;

if (!function_exists('novaui_entry_footer')) :
    /**
     * Imprime HTML con meta información para categorías, etiquetas y comentarios.
     */
    function novaui_entry_footer() {
        // Ocultar categoría y etiqueta si la publicación es privada
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'novaui'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<div class="nova-cat-links"><i class="fas fa-folder"></i> ' . esc_html__('Categorías: %1$s', 'novaui') . '</div>', $categories_list);
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'novaui'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<div class="nova-tags-links"><i class="fas fa-tags"></i> ' . esc_html__('Etiquetas: %1$s', 'novaui') . '</div>', $tags_list);
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<div class="nova-comments-link">';
            echo '<i class="fas fa-comment"></i> ';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Comentar en <span class="screen-reader-text">%s</span>', 'novaui'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</div>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Editar <span class="screen-reader-text">%s</span>', 'novaui'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<div class="nova-edit-link"><i class="fas fa-pencil-alt"></i> ',
            '</div>'
        );
    }
endif;

if (!function_exists('novaui_post_thumbnail')) :
    /**
     * Muestra una imagen destacada.
     */
    function novaui_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>
            <div class="post-thumbnail nova-card">
                <?php the_post_thumbnail('full', array('class' => 'nova-image')); ?>
            </div>
        <?php else : ?>
            <a class="post-thumbnail nova-card" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'post-thumbnail',
                    array(
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                        'class' => 'nova-image',
                    )
                );
                ?>
            </a>
        <?php
        endif;
    }
endif;

if (!function_exists('novaui_the_posts_navigation')) :
    /**
     * Muestra la navegación numérica para páginas.
     */
    function novaui_the_posts_navigation() {
        the_posts_pagination(
            array(
                'mid_size'           => 2,
                'prev_text'          => '<i class="fas fa-arrow-left"></i> ' . esc_html__('Anterior', 'novaui'),
                'next_text'          => esc_html__('Siguiente', 'novaui') . ' <i class="fas fa-arrow-right"></i>',
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__('Página', 'novaui') . ' </span>',
                'class'              => 'nova-pagination',
            )
        );
    }
endif;

if (!function_exists('novaui_comment')) :
    /**
     * Función para estilizar los comentarios.
     */
    function novaui_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        
        switch ($comment->comment_type):
            case 'pingback':
            case 'trackback':
        ?>
        <li class="post pingback">
            <p><?php esc_html_e('Pingback:', 'novaui'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('Editar', 'novaui'), '<span class="edit-link">', '</span>'); ?></p>
        <?php
                break;
            default:
        ?>
        <li <?php comment_class('nova-comment'); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment-body nova-card">
                <footer class="comment-meta">
                    <div class="comment-author vcard">
                        <?php
                        echo get_avatar($comment, 60, '', '', array('class' => 'nova-avatar'));
                        
                        printf(
                            '<span class="fn">%s</span>',
                            get_comment_author_link()
                        );
                        ?>
                    </div><!-- .comment-author -->

                    <div class="comment-metadata">
                        <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php
                                printf(
                                    /* translators: 1: comment date, 2: comment time */
                                    esc_html__('%1$s a las %2$s', 'novaui'),
                                    get_comment_date(),
                                    get_comment_time()
                                );
                                ?>
                            </time>
                        </a>
                        <?php edit_comment_link(esc_html__('Editar', 'novaui'), '<span class="edit-link">', '</span>'); ?>
                    </div><!-- .comment-metadata -->

                    <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e('Tu comentario está esperando moderación.', 'novaui'); ?></p>
                    <?php endif; ?>
                </footer><!-- .comment-meta -->

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->

                <?php
                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                            'before'    => '<div class="reply nova-button nova-button-small">',
                            'after'     => '</div>',
                        )
                    )
                );
                ?>
            </article><!-- .comment-body -->
        <?php
                break;
        endswitch;
    }
endif;

if (!function_exists('novaui_get_color_scheme')) :
    /**
     * Obtiene el esquema de colores actual del tema.
     */
    function novaui_get_color_scheme() {
        $color_scheme = array(
            'primary'   => get_theme_mod('novaui_primary_color', '#FF6B6B'),
            'secondary' => get_theme_mod('novaui_secondary_color', '#4ECDC4'),
            'accent'    => get_theme_mod('novaui_accent_color', '#FFE66D'),
            'success'   => '#7BC950',
            'warning'   => '#FFA552',
            'error'     => '#F76F8E',
            'dark'      => '#505168',
            'light'     => '#F7F9F9',
        );
        
        return $color_scheme;
    }
endif;

if (!function_exists('novaui_get_shadow_values')) :
    /**
     * Obtiene los valores de sombra según la intensidad del Neobrutalism.
     */
    function novaui_get_shadow_values() {
        $intensity = get_theme_mod('novaui_neobrutalism_intensity', 'medium');
        
        $shadow_values = array(
            'light' => array(
                'normal' => '4px 4px 0 rgba(0, 0, 0, 0.05)',
                'large'  => '6px 6px 0 rgba(0, 0, 0, 0.05)',
                'small'  => '2px 2px 0 rgba(0, 0, 0, 0.05)',
            ),
            'medium' => array(
                'normal' => '6px 6px 0 rgba(0, 0, 0, 0.1)',
                'large'  => '8px 8px 0 rgba(0, 0, 0, 0.1)',
                'small'  => '4px 4px 0 rgba(0, 0, 0, 0.1)',
            ),
            'strong' => array(
                'normal' => '8px 8px 0 rgba(0, 0, 0, 0.15)',
                'large'  => '12px 12px 0 rgba(0, 0, 0, 0.15)',
                'small'  => '6px 6px 0 rgba(0, 0, 0, 0.15)',
            ),
        );
        
        return $shadow_values[$intensity];
    }
endif;

if (!function_exists('novaui_get_card_html')) :
    /**
     * Genera HTML para una tarjeta con estilo Neobrutalism.
     */
    function novaui_get_card_html($content, $args = array()) {
        $defaults = array(
            'class'        => '',
            'title'        => '',
            'icon'         => '',
            'footer'       => '',
            'shadow_type'  => 'normal',
            'border_color' => '',
        );
        
        $args = wp_parse_args($args, $defaults);
        
        $card_class = 'nova-card';
        if (!empty($args['class'])) {
            $card_class .= ' ' . $args['class'];
        }
        
        $shadow_values = novaui_get_shadow_values();
        $shadow = isset($shadow_values[$args['shadow_type']]) ? $shadow_values[$args['shadow_type']] : $shadow_values['normal'];
        
        $style = 'box-shadow: ' . $shadow . ';';
        
        if (!empty($args['border_color'])) {
            $style .= ' border-color: ' . $args['border_color'] . ';';
        }
        
        ob_start();
        ?>
        <div class="<?php echo esc_attr($card_class); ?>" style="<?php echo esc_attr($style); ?>">
            <?php if (!empty($args['title']) || !empty($args['icon'])) : ?>
                <div class="nova-card-header">
                    <?php if (!empty($args['icon'])) : ?>
                        <i class="<?php echo esc_attr($args['icon']); ?> nova-card-icon"></i>
                    <?php endif; ?>
                    
                    <?php if (!empty($args['title'])) : ?>
                        <h3 class="nova-card-title"><?php echo esc_html($args['title']); ?></h3>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div class="nova-card-content">
                <?php echo $content; ?>
            </div>
            
            <?php if (!empty($args['footer'])) : ?>
                <div class="nova-card-footer">
                    <?php echo $args['footer']; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
endif;

if (!function_exists('novaui_get_button_html')) :
    /**
     * Genera HTML para un botón con estilo Neobrutalism.
     */
    function novaui_get_button_html($text, $url = '#', $args = array()) {
        $defaults = array(
            'class'        => '',
            'icon'         => '',
            'icon_pos'     => 'left',
            'color'        => 'primary',
            'shadow_type'  => 'normal',
            'size'         => 'medium',
            'attrs'        => array(),
        );
        
        $args = wp_parse_args($args, $defaults);
        
        $button_class = 'nova-button';
        
        if (!empty($args['class'])) {
            $button_class .= ' ' . $args['class'];
        }
        
        if ($args['color'] != 'primary') {
            $button_class .= ' nova-button-' . $args['color'];
        }
        
        if ($args['size'] != 'medium') {
            $button_class .= ' nova-button-' . $args['size'];
        }
        
        $shadow_values = novaui_get_shadow_values();
        $shadow = isset($shadow_values[$args['shadow_type']]) ? $shadow_values[$args['shadow_type']] : $shadow_values['normal'];
        
        $style = 'box-shadow: ' . $shadow . ';';
        
        $attrs = '';
        if (!empty($args['attrs'])) {
            foreach ($args['attrs'] as $attr => $value) {
                $attrs .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }
        
        ob_start();
        ?>
        <a href="<?php echo esc_url($url); ?>" class="<?php echo esc_attr($button_class); ?>" style="<?php echo esc_attr($style); ?>"<?php echo $attrs; ?>>
            <?php if (!empty($args['icon']) && $args['icon_pos'] == 'left') : ?>
                <i class="<?php echo esc_attr($args['icon']); ?> nova-button-icon-left"></i>
            <?php endif; ?>
            
            <span class="nova-button-text"><?php echo esc_html($text); ?></span>
            
            <?php if (!empty($args['icon']) && $args['icon_pos'] == 'right') : ?>
                <i class="<?php echo esc_attr($args['icon']); ?> nova-button-icon-right"></i>
            <?php endif; ?>
        </a>
        <?php
        return ob_get_clean();
    }
endif;

if (!function_exists('novaui_dashboard_icon')) :
    /**
     * Genera código HTML para un icono en el dashboard.
     */
    function novaui_dashboard_icon($icon, $args = array()) {
        $defaults = array(
            'class' => '',
            'color' => 'primary',
            'size'  => 'medium',
        );
        
        $args = wp_parse_args($args, $defaults);
        
        $color_scheme = novaui_get_color_scheme();
        $color = isset($color_scheme[$args['color']]) ? $color_scheme[$args['color']] : $color_scheme['primary'];
        
        $icon_class = 'dashboard-icon';
        
        if (!empty($args['class'])) {
            $icon_class .= ' ' . $args['class'];
        }
        
        if ($args['size'] != 'medium') {
            $icon_class .= ' dashboard-icon-' . $args['size'];
        }
        
        $style = 'color: ' . $color . ';';
        
        return '<i class="' . esc_attr($icon . ' ' . $icon_class) . '" style="' . esc_attr($style) . '"></i>';
    }
endif;
