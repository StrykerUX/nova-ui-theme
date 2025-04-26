<?php
/**
 * Template Name: Full Page
 *
 * Template para páginas con una estructura completa: header, footer, sidebar y contenido principal.
 * Esta es la plantilla por defecto para páginas estándar del sitio.
 *
 * @package NovaUI
 */

get_header();
?>

<div class="saas-content-sidebar-wrap">
    <main id="primary" class="site-main">
        <?php nova_ui_breadcrumbs(); ?>

        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('saas-page-content'); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <?php nova_ui_post_thumbnail(); ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nova-ui' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

                <?php if ( get_edit_post_link() ) : ?>
                    <footer class="entry-footer">
                        <?php
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
                        ?>
                    </footer><!-- .entry-footer -->
                <?php endif; ?>
            </article><!-- #post-<?php the_ID(); ?> -->
            <?php

            // Si los comentarios están abiertos o hay al menos un comentario, cargamos la plantilla de comentarios.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </main><!-- #primary -->

    <?php get_sidebar(); ?>
</div><!-- .saas-content-sidebar-wrap -->

<?php
get_footer();
