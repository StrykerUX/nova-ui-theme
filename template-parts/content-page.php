<?php
/**
 * Template part para mostrar el contenido de páginas
 *
 * @package NovaUI
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
    <div class="card-body">
        <?php if (!is_page_template('page-templates/dashboard.php')) : ?>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header><!-- .entry-header -->
        <?php endif; ?>

        <?php if (has_post_thumbnail() && !is_page_template('page-templates/dashboard.php')) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('full', array('class' => 'featured-image')); ?>
        </div>
        <?php endif; ?>

        <div class="entry-content">
            <?php
            the_content();

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'novaui'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->

        <?php if (get_edit_post_link() && !is_page_template('page-templates/dashboard.php')) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'novaui'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
        <?php endif; ?>
    </div><!-- .card-body -->
</article><!-- #post-<?php the_ID(); ?> -->
