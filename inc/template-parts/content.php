<?php
/**
 * Template part para mostrar posts
 *
 * @package NovaUI
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('saas-card mb-4'); ?>>
    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <span class="posted-on">
                    <?php
                    echo esc_html__( 'Posted on', 'nova-ui' ) . ' ';
                    echo '<time>' . esc_html( get_the_date() ) . '</time>';
                    ?>
                </span>
                <span class="byline">
                    <?php
                    echo esc_html__( 'by', 'nova-ui' ) . ' ';
                    echo '<span class="author">' . esc_html( get_the_author() ) . '</span>';
                    ?>
                </span>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() && !is_singular() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded' ) ); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if ( is_singular() ) :
            if ( has_post_thumbnail() ) :
                the_post_thumbnail( 'full', array( 'class' => 'img-fluid rounded mb-4' ) );
            endif;
            
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'nova-ui' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nova-ui' ),
                    'after'  => '</div>',
                )
            );
        else :
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                <?php esc_html_e( 'Read More', 'nova-ui' ); ?>
            </a>
        <?php endif; ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php if ( 'post' === get_post_type() && is_singular() ) : ?>
            <div class="entry-taxonomy">
                <?php
                // Categorías
                $categories_list = get_the_category_list( esc_html__( ', ', 'nova-ui' ) );
                if ( $categories_list ) {
                    printf(
                        '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'nova-ui' ) . '</span>',
                        $categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    );
                }

                // Etiquetas
                $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'nova-ui' ) );
                if ( $tags_list ) {
                    printf(
                        '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'nova-ui' ) . '</span>',
                        $tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    );
                }
                ?>
            </div>
        <?php endif; ?>
        
        <?php if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
            <span class="comments-link">
                <?php
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
                ?>
            </span>
        <?php endif; ?>

        <?php nova_ui_edit_post_link(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
