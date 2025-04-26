<?php
/**
 * Custom template tags para este tema
 *
 * @package NovaUI
 */

if ( ! function_exists( 'nova_ui_posted_on' ) ) :
    /**
     * Imprime HTML con meta información para la fecha actual/modificada.
     */
    function nova_ui_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x( 'Posted on %s', 'post date', 'nova-ui' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if ( ! function_exists( 'nova_ui_posted_by' ) ) :
    /**
     * Imprime HTML con meta información para el autor actual.
     */
    function nova_ui_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x( 'by %s', 'post author', 'nova-ui' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if ( ! function_exists( 'nova_ui_entry_footer' ) ) :
    /**
     * Imprime HTML con meta información para categorías, etiquetas y comentarios.
     */
    function nova_ui_entry_footer() {
        // Ocultar categoría y etiqueta para páginas.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'nova-ui' ) );
            if ( $categories_list ) {
                /* translators: 1: list of categories. */
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'nova-ui' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'nova-ui' ) );
            if ( $tags_list ) {
                /* translators: 1: list of tags. */
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'nova-ui' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'nova-ui' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );
            echo '</span>';
        }

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
            '</span>'
        );
    }
endif;

if ( ! function_exists( 'nova_ui_post_thumbnail' ) ) :
    /**
     * Muestra una imagen destacada.
     */
    function nova_ui_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) ); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'medium',
                    array(
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                        'class' => 'img-fluid',
                    )
                );
                ?>
            </a>

            <?php
        endif; // End is_singular().
    }
endif;

if ( ! function_exists( 'nova_ui_comment' ) ) :
    /**
     * Template para comentarios y pings.
     *
     * @param object $comment Objeto del comentario
     * @param array  $args Argumentos
     * @param int    $depth Profundidad
     */
    function nova_ui_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback':
            case 'trackback':
                // Mostrar trackbacks de forma diferente que los comentarios normales
                ?>
                <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'saas-pingback' ); ?>>
                    <div class="comment-body">
                        <?php esc_html_e( 'Pingback:', 'nova-ui' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'nova-ui' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                </li>
                <?php
                break;
            default:
                // Comentarios normales
                ?>
                <li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'saas-comment' : 'saas-comment parent' ); ?>>
                    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                        <footer class="comment-meta">
                            <div class="comment-author vcard">
                                <?php
                                if ( 0 !== $args['avatar_size'] ) {
                                    echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'avatar-img' ) );
                                }
                                ?>
                                <?php
                                /* translators: %s: comment author link */
                                printf( '<b class="fn">%s</b>', get_comment_author_link() );
                                ?>
                            </div><!-- .comment-author -->

                            <div class="comment-metadata">
                                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                    <time datetime="<?php comment_time( 'c' ); ?>">
                                        <?php
                                        /* translators: 1: comment date, 2: comment time */
                                        printf( esc_html__( '%1$s at %2$s', 'nova-ui' ), get_comment_date(), get_comment_time() );
                                        ?>
                                    </time>
                                </a>
                                <?php edit_comment_link( esc_html__( 'Edit', 'nova-ui' ), '<span class="edit-link">', '</span>' ); ?>
                            </div><!-- .comment-metadata -->

                            <?php if ( '0' === $comment->comment_approved ) : ?>
                                <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'nova-ui' ); ?></p>
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
                                    'add_below'  => 'div-comment',
                                    'depth'      => $depth,
                                    'max_depth'  => $args['max_depth'],
                                    'before'     => '<div class="reply">',
                                    'after'      => '</div>',
                                )
                            )
                        );
                        ?>
                    </article><!-- .comment-body -->
                </li>
                <?php
                break;
        endswitch;
    }
endif;

if ( ! function_exists( 'nova_ui_breadcrumbs' ) ) :
    /**
     * Muestra migas de pan
     */
    function nova_ui_breadcrumbs() {
        // No mostrar en la página principal
        if ( is_front_page() ) {
            return;
        }
    
        // Lista de elementos para las migas
        echo '<nav class="saas-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumbs', 'nova-ui' ) . '">';
        echo '<ul>';
    
        // Inicio
        echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'nova-ui' ) . '</a></li>';
    
        if ( is_category() || is_single() ) {
            // Categoría o post individual
            if ( is_category() ) {
                echo '<li>' . single_cat_title( '', false ) . '</li>';
            } elseif ( is_single() ) {
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    echo '<li><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></li>';
                }
                echo '<li>' . get_the_title() . '</li>';
            }
        } elseif ( is_page() ) {
            // Página - AQUÍ ESTÁ EL FIX
            global $post; // Asegurarse de que $post esté disponible
            if ( $post && $post->post_parent ) { // Verificar que $post no sea nulo
                $ancestors = get_post_ancestors( $post->ID );
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor ) {
                    echo '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . get_the_title( $ancestor ) . '</a></li>';
                }
            }
            echo '<li>' . get_the_title() . '</li>';
        } elseif ( is_search() ) {
            // Página de búsqueda
            echo '<li>' . esc_html__( 'Search results for: ', 'nova-ui' ) . get_search_query() . '</li>';
        } elseif ( is_404() ) {
            // Página 404
            echo '<li>' . esc_html__( 'Error 404', 'nova-ui' ) . '</li>';
        } elseif ( is_archive() ) {
            // Archivos
            if ( is_day() ) {
                echo '<li>' . esc_html__( 'Archives for: ', 'nova-ui' ) . get_the_date() . '</li>';
            } elseif ( is_month() ) {
                echo '<li>' . esc_html__( 'Archives for: ', 'nova-ui' ) . get_the_date( 'F Y' ) . '</li>';
            } elseif ( is_year() ) {
                echo '<li>' . esc_html__( 'Archives for: ', 'nova-ui' ) . get_the_date( 'Y' ) . '</li>';
            } elseif ( is_author() ) {
                echo '<li>' . esc_html__( 'Author Archives: ', 'nova-ui' ) . get_the_author() . '</li>';
            } else {
                echo '<li>' . esc_html__( 'Archives', 'nova-ui' ) . '</li>';
            }
        }
    
        echo '</ul>';
        echo '</nav>';
    }
endif;

if ( ! function_exists( 'nova_ui_pagination' ) ) :
    /**
     * Muestra paginación para páginas de archivo
     */
    function nova_ui_pagination() {
        the_posts_pagination(
            array(
                'mid_size'           => 2,
                'prev_text'          => '<span class="screen-reader-text">' . esc_html__( 'Previous', 'nova-ui' ) . '</span>&laquo;',
                'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next', 'nova-ui' ) . '</span>&raquo;',
                'screen_reader_text' => esc_html__( 'Posts navigation', 'nova-ui' ),
                'class'              => 'saas-pagination',
            )
        );
    }
endif;

if ( ! function_exists( 'nova_ui_get_svg_icon' ) ) :
    /**
     * Muestra un icono SVG (versión mejorada)
     *
     * @param string $icon Nombre del icono
     * @param string $size Tamaño del icono (sm, md, lg)
     * @return string HTML para el icono SVG
     */
    function nova_ui_get_svg_icon( $icon, $size = 'md' ) {
        // Tamaños de iconos
        $sizes = array(
            'sm' => '16',
            'md' => '24',
            'lg' => '32',
            'xl' => '48'
        );
        
        $width_height = isset( $sizes[ $size ] ) ? $sizes[ $size ] : $sizes['md'];
        
        // Buscar primero en la biblioteca extendida si existe
        $lucide_icons_path = get_template_directory() . '/inc/lucide-icons.php';
        
        if (file_exists($lucide_icons_path)) {
            $lucide_icons = include $lucide_icons_path;
            
            // Si el icono existe en la biblioteca extendida, usarlo
            if (is_array($lucide_icons) && isset($lucide_icons[$icon])) {
                $svg = $lucide_icons[$icon];
                // Ajustar tamaño si es necesario
                if ($width_height != '24') {
                    $svg = str_replace('width="24"', 'width="' . $width_height . '"', $svg);
                    $svg = str_replace('height="24"', 'height="' . $width_height . '"', $svg);
                }
                return $svg;
            }
        }
        
        // Iconos básicos disponibles (si no se encuentra en la biblioteca extendida)
        $icons = array(
            'menu' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width_height . '" height="' . $width_height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>',
            'search' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width_height . '" height="' . $width_height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            'sun' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width_height . '" height="' . $width_height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>',
            'moon' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width_height . '" height="' . $width_height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>',
            'user' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width_height . '" height="' . $width_height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
            'chevron-down' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width_height . '" height="' . $width_height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>',
            'chevron-up' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width_height . '" height="' . $width_height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>',
            'play' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width_height . '" height="' . $width_height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>',
            'help-circle' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width_height . '" height="' . $width_height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>',
        );
        
        // Si el icono existe, devolverlo
        if ( isset( $icons[ $icon ] ) ) {
            return $icons[ $icon ];
        }
        
        // Icono por defecto si no existe
        return $icons['help-circle'];
    }
endif;
